<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnershipCtaSetting extends Model
{
    protected $fillable = [
        'headline', 'subtext',
        'button_1_text', 'button_1_url',
        'wa_number', 'wa_message',
        'button_2_text', 'button_2_url',
        'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
