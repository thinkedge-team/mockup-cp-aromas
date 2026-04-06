<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon',
        'label',
        'title',
        'slug',
        'description',
        'order',
        'is_active',
    ];

    protected $casts = [
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get all brand-category pivot records for this category
     */
    public function brandCategories()
    {
        return $this->hasMany(BrandCategory::class, 'category_id');
    }

    /**
     * Get brands through pivot (many-to-many)
     */
    public function brands()
    {
        return $this->belongsToMany(ProductBrand::class, 'brand_category', 'category_id', 'brand_id')
            ->withPivot(['order', 'is_active'])
            ->withTimestamps();
    }

    /**
     * Get active brands for this category
     */
    public function activeBrands()
    {
        return $this->belongsToMany(ProductBrand::class, 'brand_category', 'category_id', 'brand_id')
            ->withPivot(['order', 'is_active'])
            ->wherePivot('is_active', true)
            ->where('product_brands.is_active', true);
    }

    /**
     * Get all products in this category
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    /**
     * Get active products in this category
     */
    public function activeProducts()
    {
        return $this->hasMany(Product::class, 'category_id')
            ->where('is_active', true)
            ->orderBy('order');
    }

    /**
     * Scope for active categories
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    /**
     * Scope to filter by brand (through pivot)
     */
    public function scopeForBrand($query, $brandId)
    {
        return $query->whereHas('brandCategories', function ($q) use ($brandId) {
            $q->where('brand_id', $brandId)
              ->where('is_active', true);
        });
    }

    /**
     * Get active categories for a specific brand
     */
    public static function getActiveForBrand($brandId)
    {
        return static::active()
            ->whereHas('brandCategories', function ($q) use ($brandId) {
                $q->where('brand_id', $brandId)
                  ->where('is_active', true);
            })
            ->get();
    }
}
