<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactHeroSetting extends Model
{
    protected $fillable = [
        'badge_text', 'title_line1', 'title_highlight', 'description',
        'chip_1_icon', 'chip_1_text', 'chip_1_value',
        'chip_2_icon', 'chip_2_text', 'chip_2_value',
        'chip_3_icon', 'chip_3_text', 'chip_3_value',
    ];
}
