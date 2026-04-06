<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCampaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'promo_category_id',
        'name',
        'tagline',
        'description',
        'discount_percentage',
        'discount_value',
        'code',
        'min_purchase',
        'start_date',
        'end_date',
        'is_active',
        'is_featured',
        'sort_order',
        'status_badge',
        'whatsapp_message',
        'images',
        'details',
        'terms',
        'button_label',
        'button_link',
    ];

    protected $casts = [
        'discount_percentage' => 'integer',
        'discount_value' => 'decimal:2',
        'min_purchase' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
        'images' => 'array',
        'details' => 'array',
        'terms' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(PromoFilterCategory::class, 'promo_category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->whereHas('category', function ($q) {
                $q->where('is_active', true);
            })
            ->where(function ($q) {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', now()->startOfDay());
            });
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    public function isExpired(): bool
    {
        return $this->end_date && $this->end_date->isPast();
    }

    public function getDaysRemainingAttribute(): ?int
    {
        if (!$this->end_date) {
            return null;
        }

        return max(0, now()->diffInDays($this->end_date, false));
    }
}
