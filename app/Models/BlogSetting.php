<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'badge_text',
        'title',
        'title_emphasis',
        'description',
        'stats',
        'meta_title',
        'meta_description',
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
            // Ensure JSON fields are properly decoded
            if (is_string($instance->stats)) {
                $instance->stats = json_decode($instance->stats, true) ?? [];
            }
            if (is_string($instance->cta_buttons)) {
                $instance->cta_buttons = json_decode($instance->cta_buttons, true) ?? [];
            }
        }
        return $instance;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
