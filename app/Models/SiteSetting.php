<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SiteSetting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'order',
        'is_active',
    ];

    protected $casts = [
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get the value attribute
     */
    public function getValueAttribute($value)
    {
        // Only decode JSON for array-based types
        if (in_array($this->type, ['social', 'contact', 'array'])) {
            return json_decode($value, true) ?? [];
        }
        
        // Return raw value for other types
        return $value;
    }

    /**
     * Set the value attribute
     */
    public function setValueAttribute($value)
    {
        // Encode arrays to JSON for array-based types
        if (is_array($value) && in_array($this->type, ['social', 'contact', 'array'])) {
            $this->attributes['value'] = json_encode($value);
        } else {
            $this->attributes['value'] = $value;
        }
    }

    /**
     * Get a specific setting value
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();
        return $setting?->value ?? $default;
    }

    /**
     * Set a specific setting value
     */
    public static function set(string $key, mixed $value, array $options = []): void
    {
        $setting = static::where('key', $key)->first();
        
        if ($setting) {
            $setting->update([
                'value' => $value,
                ...$options,
            ]);
        } else {
            static::create([
                'key' => $key,
                'value' => $value,
                'label' => $options['label'] ?? $key,
                'type' => $options['type'] ?? 'text',
                'group' => $options['group'] ?? 'general',
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
            ->pluck('value', 'key')
            ->toArray();
    }
}
