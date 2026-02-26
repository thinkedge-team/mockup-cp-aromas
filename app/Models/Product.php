<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
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
        'category_id' => 'integer',
        'images' => 'array',
        'sizes' => 'array',
        'features' => 'array',
        'modal_details' => 'array',
        'modal_features' => 'array',
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function scopeByCategory($query, $slug)
    {
        return $query->whereHas('category', function ($q) use ($slug) {
            $q->where('slug', $slug);
        });
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
}
