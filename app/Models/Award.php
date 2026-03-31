<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Award extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'organization',
        'year',
        'status_color',
        'order',
        'is_active',
    ];

    protected $casts = [
        'year' => 'integer',
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    /**
     * Auto-convert status_color to lowercase to prevent case-sensitivity issues
     */
    protected function statusColor(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower(trim($value)),
        );
    }
}
