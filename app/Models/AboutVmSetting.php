<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutVmSetting extends Model
{
    protected $fillable = [
        'section_title_main',
        'section_subtitle',
        'vision_text',
        'mission_items',
        'is_active',
    ];

    protected $casts = [
        'mission_items' => 'array',
        'is_active'     => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
