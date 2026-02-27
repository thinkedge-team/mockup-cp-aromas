<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineHero extends Model
{
    use HasFactory;

    protected $fillable = [
        'badge_icon',
        'badge_text',
        'title',
        'title_gradient',
        'production_line_image',
        'hero_stats',
        'is_active',
    ];

    protected $casts = [
        'hero_stats' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
