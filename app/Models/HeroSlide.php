<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    use HasFactory;

    protected $fillable = [
        'order',
        'badge_icon',
        'badge_text',
        'title',
        'title_gradient',
        'description',
        'pills',
        'primary_button_text',
        'primary_button_url',
        'secondary_button_text',
        'secondary_button_url',
        'trust_items',
        'floating_cards',
        'background_image',
        'product_image',
        'is_active',
    ];

    protected $casts = [
        'order' => 'integer',
        'pills' => 'array',
        'trust_items' => 'array',
        'floating_cards' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    /**
     * Get pills attribute - handle both old and new format
     */
    public function getPillsAttribute($value)
    {
        $pills = json_decode($value, true) ?? [];
        
        // Convert old format (array of strings) to new format (array of objects)
        return array_map(function($pill) {
            if (is_string($pill)) {
                return ['text' => $pill];
            }
            return $pill;
        }, $pills);
    }

    /**
     * Get trust items attribute - handle both formats
     */
    public function getTrustItemsAttribute($value)
    {
        $items = json_decode($value, true) ?? [];
        
        // Ensure all items have both number and label
        return array_map(function($item) {
            if (is_string($item)) {
                // Old format: just the number
                return ['number' => $item, 'label' => ''];
            }
            return $item;
        }, $items);
    }

    /**
     * Get floating cards attribute - handle both formats
     */
    public function getFloatingCardsAttribute($value)
    {
        $cards = json_decode($value, true) ?? [];
        
        // Ensure all cards have icon, title, and subtitle
        return array_map(function($card) {
            if (is_string($card)) {
                // Old format: just the title
                return ['icon' => '', 'title' => $card, 'subtitle' => ''];
            }
            return $card;
        }, $cards);
    }
}
