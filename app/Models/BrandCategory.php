<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandCategory extends Model
{
    use HasFactory;

    protected $table = 'brand_category';

    protected $fillable = [
        'brand_id',
        'category_id',
        'order',
        'is_active',
    ];

    protected $casts = [
        'brand_id' => 'integer',
        'category_id' => 'integer',
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get the brand for this combination
     */
    public function brand()
    {
        return $this->belongsTo(ProductBrand::class, 'brand_id');
    }

    /**
     * Get the category for this combination
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    /**
     * Get products for this brand-category combination
     */
    public function products()
    {
        return Product::where('brand_id', $this->brand_id)
            ->where('category_id', $this->category_id);
    }

    /**
     * Scope for active combinations
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->whereHas('brand', fn($q) => $q->where('is_active', true))
            ->whereHas('category', fn($q) => $q->where('is_active', true))
            ->orderBy('order');
    }

    /**
     * Scope to filter by brand
     */
    public function scopeForBrand($query, $brandId)
    {
        return $query->where('brand_id', $brandId);
    }

    /**
     * Scope to filter by category
     */
    public function scopeForCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Get product count for this combination
     */
    public function getProductCountAttribute()
    {
        return Product::where('brand_id', $this->brand_id)
            ->where('category_id', $this->category_id)
            ->where('is_active', true)
            ->count();
    }
}
