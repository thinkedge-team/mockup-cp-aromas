<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactWhySetting extends Model
{
    protected $fillable = [
        'label', 'title', 'title_highlight', 'why_items',
        'hours_weekday', 'hours_saturday', 'hours_sunday', 'hours_wa_note',
        'wa_url', 'instagram_url', 'facebook_url', 'youtube_url', 'tiktok_url', 'email_address',
    ];

    protected $casts = [
        'why_items' => 'array',
    ];
}
