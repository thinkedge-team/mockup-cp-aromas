<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactFaq extends Model
{
    protected $fillable = [
        'icon', 'question', 'answer', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
