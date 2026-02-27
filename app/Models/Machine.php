<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'tagline',
        'unit_count',
        'capacity_badge',
        'images',
        'specs',
        'components',
        'modal_title',
        'modal_subtitle',
        'modal_description',
        'whatsapp_message',
        'order',
        'is_active',
    ];

    protected $casts = [
        'category_id' => 'integer',
        'images' => 'array',
        'specs' => 'array',
        'components' => 'array',
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(MachineCategory::class, 'category_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    /**
     * Get primary image (for card display)
     */
    public function getPrimaryImageAttribute()
    {
        $images = $this->images ?? [];
        foreach ($images as $image) {
            if (!empty($image['is_primary'])) {
                return $image['url'];
            }
        }
        // Fallback to first image
        return $images[0]['url'] ?? null;
    }

    /**
     * Get gallery images (excluding primary)
     */
    public function getGalleryImagesAttribute()
    {
        $images = $this->images ?? [];
        return array_filter($images, fn($img) => empty($img['is_primary']));
    }
}
