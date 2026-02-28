<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnershipHeroSetting extends Model
{
    protected $fillable = [
        'badge_text', 'title_main', 'title_italic',
        'description', 'wa_number', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
