<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoHowtoSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'tag',
        'icon',
        'title',
        'description',
        'steps',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'steps' => 'array',
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
