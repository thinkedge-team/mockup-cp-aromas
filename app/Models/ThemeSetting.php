<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ThemeSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'setting_key',
        'setting_value',
        'setting_type',
        'label',
        'group',
        'order',
        'is_active',
    ];

    protected $casts = [
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get a specific theme setting
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = static::where('setting_key', $key)->first();
        return $setting?->setting_value ?? $default;
    }

    /**
     * Set a specific theme setting
     */
    public static function set(string $key, string $value, array $options = []): void
    {
        $setting = static::where('setting_key', $key)->first();
        
        if ($setting) {
            $setting->update(['setting_value' => $value]);
        } else {
            static::create([
                'setting_key' => $key,
                'setting_value' => $value,
                'label' => $options['label'] ?? $key,
                'setting_type' => $options['type'] ?? 'color',
                'group' => $options['group'] ?? 'colors',
                'order' => $options['order'] ?? 0,
            ]);
        }
    }

    /**
     * Get all settings for a group
     */
    public static function getGroup(string $group): array
    {
        return static::where('group', $group)
            ->where('is_active', true)
            ->orderBy('order')
            ->get()
            ->pluck('setting_value', 'setting_key')
            ->toArray();
    }

    /**
     * Get all theme settings as key-value pairs
     */
    public static function getAll(): array
    {
        return static::where('is_active', true)
            ->orderBy('group')
            ->orderBy('order')
            ->get()
            ->pluck('setting_value', 'setting_key')
            ->toArray();
    }
}
