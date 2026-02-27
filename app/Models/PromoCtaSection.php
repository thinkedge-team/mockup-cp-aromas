<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCtaSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'title',
        'description',
        'buttons',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'buttons' => 'array',
    ];

    public static function getInstance(): ?self
    {
        return static::first();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
