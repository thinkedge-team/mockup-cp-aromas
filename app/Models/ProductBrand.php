<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductBrand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'order',
        'is_active',
    ];

    protected $casts = [
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('name') && !$model->isDirty('slug')) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    /**
     * Get all brand-category pivot records for this brand
     */
    public function brandCategories()
    {
        return $this->hasMany(BrandCategory::class, 'brand_id');
    }

    /**
     * Get active brand-category combinations
     */
    public function activeBrandCategories()
    {
        return $this->hasMany(BrandCategory::class, 'brand_id')
            ->where('is_active', true)
            ->whereHas('category', fn($q) => $q->where('is_active', true))
            ->orderBy('order');
    }

    /**
     * Get categories through pivot (many-to-many)
     */
    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'brand_category', 'brand_id', 'category_id')
            ->withPivot(['order', 'is_active'])
            ->withTimestamps();
    }

    /**
     * Get active categories for this brand
     */
    public function activeCategories()
    {
        return $this->belongsToMany(ProductCategory::class, 'brand_category', 'brand_id', 'category_id')
            ->withPivot(['order', 'is_active'])
            ->wherePivot('is_active', true)
            ->where('product_categories.is_active', true)
            ->orderBy('brand_category.order');
    }

    /**
     * Get all products for this brand
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }

    /**
     * Get active products for this brand
     */
    public function activeProducts()
    {
        return $this->hasMany(Product::class, 'brand_id')
            ->where('is_active', true)
            ->orderBy('order');
    }

    /**
     * Scope for active brands
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    /**
     * Check if brand has any active products
     */
    public function hasActiveProducts()
    {
        return $this->products()
            ->where('is_active', true)
            ->whereHas('category', fn($q) => $q->where('is_active', true))
            ->exists();
    }
}
