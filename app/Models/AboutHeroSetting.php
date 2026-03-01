<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutHeroSetting extends Model
{
    protected $fillable = [
        'badge_text',
        'title_main',
        'title_italic',
        'description',
        'stats',
        'is_active',
    ];

    protected $casts = [
        'stats'     => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
