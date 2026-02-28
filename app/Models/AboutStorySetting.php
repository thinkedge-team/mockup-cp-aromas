<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutStorySetting extends Model
{
    protected $fillable = [
        'badge_text',
        'title_main',
        'title_italic',
        'lead_paragraph',
        'body_paragraph_1',
        'body_paragraph_2',
        'story_image',
        'founded_year',
        'founded_label',
        'cert_badge_text',
        'pills',
        'is_active',
    ];

    protected $casts = [
        'pills'        => 'array',
        'founded_year' => 'integer',
        'is_active'    => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
