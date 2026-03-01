<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnershipTestimonial extends Model
{
    protected $fillable = [
        'name', 'role', 'avatar_url', 'text',
        'program_type', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active'  => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
