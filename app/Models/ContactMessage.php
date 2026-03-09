<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'subject',
        'name',
        'company',
        'email',
        'phone',
        'product',
        'volume',
        'city',
        'message',
        'attachments',
        'status',
        'notes',
        'followed_up_by',
        'followed_up_at',
    ];

    protected $casts = [
        'attachments'    => 'array',
        'followed_up_at' => 'datetime',
    ];

    /**
     * Status labels in Indonesian.
     */
    public static array $statusLabels = [
        'new'         => 'Baru',
        'in_progress' => 'Diproses',
        'done'        => 'Selesai',
        'rejected'    => 'Ditolak',
    ];

    /**
     * Status badge colors for Filament.
     */
    public static array $statusColors = [
        'new'         => 'info',
        'in_progress' => 'warning',
        'done'        => 'success',
        'rejected'    => 'danger',
    ];

    /**
     * Get human-readable status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return self::$statusLabels[$this->status] ?? $this->status;
    }

    /**
     * Check if message is new / unhandled.
     */
    public function isNew(): bool
    {
        return $this->status === 'new';
    }

    /**
     * Scope: only new messages.
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }
}
