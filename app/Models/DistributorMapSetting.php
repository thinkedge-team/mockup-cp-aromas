<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistributorMapSetting extends Model
{
    protected $fillable = [
        'section_title',
        'section_subtitle',
        'default_pin_image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
