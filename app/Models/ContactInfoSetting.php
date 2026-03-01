<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfoSetting extends Model
{
    protected $fillable = [
        'address_title', 'address_text', 'address_maps_url', 'address_action_label',
        'phone_title', 'phone_office', 'phone_fax', 'phone_email', 'phone_number', 'phone_action_label',
        'wa_title', 'wa_sales_label', 'wa_sales_display', 'wa_sales_number',
        'wa_dist_label', 'wa_dist_display', 'wa_note', 'wa_action_label',
        'hours_title', 'hours_weekday_label', 'hours_weekday_value',
        'hours_saturday_label', 'hours_saturday_value', 'hours_sunday_value',
    ];
}
