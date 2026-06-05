<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistributorCtaSetting extends Model
{
    protected $fillable = [
        'headline',
        'subtext',
        'button_text',
        'button_url',
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
