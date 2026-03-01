<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnershipCompareSetting extends Model
{
    protected $fillable = ['section_title', 'section_subtitle', 'rows', 'is_active'];

    protected $casts = [
        'rows'      => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
