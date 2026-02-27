<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoHeroSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'badge_text',
        'badge_icon',
        'title',
        'description',
        'countdown_label',
        'countdown_target',
        'stats',
        'float_tags',
        'background_color_start',
        'background_color_end',
        'is_active',
    ];

    protected $casts = [
        'countdown_target' => 'datetime',
        'stats' => 'array',
        'float_tags' => 'array',
        'is_active' => 'boolean',
    ];

    public static function getInstance(): ?self
    {
        return static::first();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
