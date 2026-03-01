<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnershipStat extends Model
{
    protected $fillable = ['stats', 'is_active'];

    protected $casts = [
        'stats'     => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
