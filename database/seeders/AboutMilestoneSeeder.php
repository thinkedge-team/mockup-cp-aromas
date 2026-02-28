<?php

namespace Database\Seeders;

use App\Models\AboutMilestone;
use Illuminate\Database\Seeder;

class AboutMilestoneSeeder extends Seeder
{
    public function run(): void
    {
        $milestones = [
            [
                'year'        => 2009,
                'title'       => 'Pendirian AROMAS',
                'description' => 'AROMAS resmi berdiri sebagai perusahaan minyak goreng di Jakarta dengan kapasitas produksi awal 100 ton per bulan.',
                'icon'        => 'flag-fill',
                'sort_order'  => 1,
            ],
            [
                'year'        => 2013,
                'title'       => 'Sertifikasi Halal & BPOM',
                'description' => 'Memperoleh sertifikasi Halal MUI dan izin edar BPOM, memperkuat kepercayaan konsumen di seluruh Indonesia.',
                'icon'        => 'patch-check-fill',
                'sort_order'  => 2,
            ],
            [
                'year'        => 2016,
                'title'       => 'Ekspansi Nasional',
                'description' => 'Jaringan distribusi AROMAS meluas ke 34 provinsi melalui kemitraan dengan lebih dari 200 distributor lokal.',
                'icon'        => 'geo-alt-fill',
                'sort_order'  => 3,
            ],
            [
                'year'        => 2019,
                'title'       => 'ISO 22000:2018',
                'description' => 'Meraih sertifikasi ISO 22000:2018 — standar manajemen keamanan pangan internasional — sebuah pencapaian bersejarah.',
                'icon'        => 'award-fill',
                'sort_order'  => 4,
            ],
            [
                'year'        => 2022,
                'title'       => '1 Juta Pelanggan',
                'description' => 'Milestone luar biasa: lebih dari 1 juta keluarga Indonesia memilih AROMAS sebagai minyak goreng andalan sehari-hari.',
                'icon'        => 'people-fill',
                'sort_order'  => 5,
            ],
            [
                'year'        => 2024,
                'title'       => 'Top Brand Award',
                'description' => 'Menerima penghargaan Top Brand Award kategori minyak goreng dari Frontier Consulting Group atas loyalitas konsumen tertinggi.',
                'icon'        => 'trophy-fill',
                'sort_order'  => 6,
            ],
        ];

        foreach ($milestones as $milestone) {
            AboutMilestone::create(array_merge($milestone, ['is_active' => true]));
        }
    }
}
