<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class FooterSetting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'logo',
        'company_description',
        'contact_info',
        'social_links',
        'copyright_text',
        'legal_links',
        'is_active',
    ];

    protected $casts = [
        'contact_info' => 'array',
        'social_links' => 'array',
        'legal_links' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get active footer settings
     */
    public static function getActive(): ?self
    {
        return static::where('is_active', true)->first();
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
