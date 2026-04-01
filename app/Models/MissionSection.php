<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'mission_text',
        'highlight_text',
        'middle_text',
        'eco_badge_icon',
        'eco_badge_text',
        'transition_text',
        'mission_text_continued',
        'leaf_icon',
        'final_text',
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
