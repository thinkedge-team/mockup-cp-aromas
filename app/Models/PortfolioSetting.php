<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'badge_text',
        'badge_icon',
        'title',
        'title_emphasis',
        'description',
        'stats',
        'is_active',
    ];

    protected $casts = [
        'stats' => 'array',
        'is_active' => 'boolean',
    ];

    public static function getInstance(): ?self
    {
        $instance = static::first();
        if ($instance) {
            if (is_string($instance->stats)) {
                $instance->stats = json_decode($instance->stats, true) ?? [];
            }
        }
        return $instance;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
