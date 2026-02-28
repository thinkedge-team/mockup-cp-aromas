<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMapSetting extends Model
{
    protected $fillable = [
        'section_label', 'section_title', 'section_desc',
        'map_embed_url', 'map_card_title', 'map_card_address',
        'map_card_direction_url', 'branch_section_title',
    ];
}
