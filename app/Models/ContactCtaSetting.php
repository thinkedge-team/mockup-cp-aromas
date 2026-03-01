<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactCtaSetting extends Model
{
    protected $fillable = [
        'title', 'description',
        'btn_wa_label', 'btn_wa_number', 'btn_wa_message',
        'btn_phone_label', 'btn_phone_number',
    ];
}
