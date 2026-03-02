<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioCtaSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_emphasis',
        'description',
        'buttons',
        'is_active',
    ];

    protected $casts = [
        'buttons' => 'array',
        'is_active' => 'boolean',
    ];

    public static function getInstance(): ?self
    {
        $instance = static::first();
        if ($instance) {
            if (is_string($instance->buttons)) {
                $instance->buttons = json_decode($instance->buttons, true) ?? [];
            }
        }
        return $instance;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
