<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'category_id',
        'name',
        'tagline',
        'badge_text',
        'images',
        'sizes',
        'features',
        'modal_title',
        'modal_subtitle',
        'modal_details',
        'modal_features',
        'whatsapp_message',
        'order',
        'is_active',
    ];

    protected $casts = [
        'brand_id' => 'integer',
        'category_id' => 'integer',
        'images' => 'array',
        'sizes' => 'array',
        'features' => 'array',
        'modal_details' => 'array',
        'modal_features' => 'array',
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get the brand for this product
     */
    public function brand()
    {
        return $this->belongsTo(ProductBrand::class, 'brand_id');
    }

    /**
     * Get the category for this product
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    /**
     * Scope for fully active products
     * Checks: product active, brand active, category active, brand-category combination active
     */
    public function scopeActive($query)
    {
        return $query->where('products.is_active', true)
            ->whereHas('brand', fn($q) => $q->where('is_active', true))
            ->whereHas('category', fn($q) => $q->where('is_active', true))
            ->where(function ($q) {
                $q->whereExists(function ($subQuery) {
                    $subQuery->from('brand_category')
                        ->whereColumn('brand_category.brand_id', 'products.brand_id')
                        ->whereColumn('brand_category.category_id', 'products.category_id')
                        ->where('brand_category.is_active', true);
                });
            })
            ->orderBy('products.order');
    }

    /**
     * Scope for products by brand
     */
    public function scopeForBrand($query, $brandId)
    {
        return $query->where('brand_id', $brandId);
    }

    /**
     * Scope for products by category
     */
    public function scopeByCategory($query, $slug)
    {
        return $query->whereHas('category', function ($q) use ($slug) {
            $q->where('slug', $slug);
        });
    }

    /**
     * Scope for products by brand and category
     */
    public function scopeForBrandCategory($query, $brandId, $categoryId)
    {
        return $query->where('brand_id', $brandId)
            ->where('category_id', $categoryId);
    }

    /**
     * Check if the brand-category combination is active
     */
    public function isBrandCategoryActive()
    {
        return BrandCategory::where('brand_id', $this->brand_id)
            ->where('category_id', $this->category_id)
            ->where('is_active', true)
            ->exists();
    }

    /**
     * Get the banner image (first image with is_banner = true)
     */
    public function getBannerImageAttribute()
    {
        $images = $this->images ?? [];
        foreach ($images as $image) {
            if (!empty($image['is_banner'])) {
                return $image['url'];
            }
        }
        // Fallback to first image if no banner set
        return $images[0]['url'] ?? null;
    }

    /**
     * Get gallery images (excluding banner)
     */
    public function getGalleryImagesAttribute()
    {
        $images = $this->images ?? [];
        return array_filter($images, fn($img) => empty($img['is_banner']));
    }

    /**
     * Get products that are fully displayable (all parent entities active)
     */
    public static function getDisplayable()
    {
        return static::active()->with(['brand', 'category'])->get();
    }
}
