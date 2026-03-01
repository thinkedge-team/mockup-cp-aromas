<?php

namespace Database\Seeders;

use App\Models\ContactInfoSetting;
use Illuminate\Database\Seeder;

class ContactInfoSettingSeeder extends Seeder
{
    public function run(): void
    {
        ContactInfoSetting::truncate();
        ContactInfoSetting::create([
            'address_title'        => 'Kantor Pusat',
            'address_text'         => "Jl. Industri Raya No. 123\nKawasan Industri, Jakarta 12345\nDKI Jakarta, Indonesia",
            'address_maps_url'     => 'https://maps.google.com/?q=Jakarta+Pusat',
            'address_action_label' => 'Lihat di Maps',
            'phone_title'          => 'Telepon & Fax',
            'phone_office'         => '(021) 1234-5678',
            'phone_fax'            => '(021) 1234-5679',
            'phone_email'          => 'info@aromas.co.id',
            'phone_number'         => '02112345678',
            'phone_action_label'   => 'Hubungi Sekarang',
            'wa_title'             => 'WhatsApp',
            'wa_sales_label'       => 'Sales',
            'wa_sales_display'     => '+62 812-3456-7890',
            'wa_sales_number'      => '6281234567890',
            'wa_dist_label'        => 'Distribusi',
            'wa_dist_display'      => '+62 811-2345-6789',
            'wa_note'              => '● Aktif 24 jam untuk order',
            'wa_action_label'      => 'Chat Sekarang',
            'hours_title'          => 'Jam Operasional',
            'hours_weekday_label'  => 'Kantor',
            'hours_weekday_value'  => 'Sen – Jum: 08.00 – 17.00',
            'hours_saturday_label' => 'Fax',
            'hours_saturday_value' => 'Sabtu: 08.00 – 13.00',
            'hours_sunday_value'   => 'Minggu: Tutup',
        ]);
    }
}
