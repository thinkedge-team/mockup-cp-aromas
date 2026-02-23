<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class NavigationSetting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'location',
        'menu_items',
        'logo',
        'logo_height',
        'cta_button_text',
        'cta_button_url',
        'is_sticky',
        'is_active',
    ];

    protected $casts = [
        'menu_items' => 'array',
        'logo_height' => 'integer',
        'is_sticky' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get navigation by location
     */
    public static function getByLocation(string $location): ?self
    {
        return static::where('location', $location)
            ->where('is_active', true)
            ->first();
    }

    /**
     * Register media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->singleFile()
            ->onlyAcceptsMediaTypes(['image/png', 'image/jpeg', 'image/svg+xml']);
    }
}
