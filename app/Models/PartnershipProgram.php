<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnershipProgram extends Model
{
    protected $fillable = [
        'slug', 'name', 'icon', 'color_hex', 'image_url',
        'badge_label', 'panel_title', 'panel_subtitle',
        'info_items', 'benefits', 'requirements', 'steps',
        'cta_title', 'cta_subtitle', 'cta_wa_text',
        'cta_btn_wa_label', 'cta_btn_form_label',
        'is_active', 'sort_order',
    ];

    protected $casts = [
        'info_items'   => 'array',
        'benefits'     => 'array',
        'requirements' => 'array',
        'steps'        => 'array',
        'is_active'    => 'boolean',
        'sort_order'   => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
