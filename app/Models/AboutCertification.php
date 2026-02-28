<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutCertification extends Model
{
    protected $fillable = [
        'icon',
        'name',
        'issuer',
        'year',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'year'       => 'integer',
        'sort_order' => 'integer',
        'is_active'  => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
