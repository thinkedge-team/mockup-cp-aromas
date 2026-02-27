<?php

namespace Database\Seeders;

use App\Models\Machine;
use Illuminate\Database\Seeder;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // MACHINE 1: Blowing Machine (category_id = 1)
        Machine::create([
            'category_id' => 1,
            'name' => 'Blowing Machine GY-GB-4SS',
            'tagline' => 'Automatic bottle blowing dengan 3 servo motors presisi tinggi',
            'unit_count' => 1,
            'capacity_badge' => '6.000 BPH',
            'images' => [
                ['url' => 'https://images.unsplash.com/photo-1565043589221-1a6fd9ae45c7?w=700&h=440&fit=crop', 'order' => 0, 'is_primary' => true],
                ['url' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=700&h=440&fit=crop', 'order' => 1, 'is_primary' => false],
                ['url' => 'https://images.unsplash.com/photo-1565043589221-1a6fd9ae45c7?w=700&h=440&fit=crop&sat=-50', 'order' => 2, 'is_primary' => false],
            ],
            'specs' => [
                ['label' => 'Model', 'value' => 'GY-GB-4SS automatic', 'order' => 1],
                ['label' => 'Motors', 'value' => '3-servo motors', 'order' => 2],
                ['label' => 'Capacity', 'value' => '6.000 BPH', 'order' => 3],
            ],
            'components' => [
                ['name' => 'RGF24-8 Main filling and capping machine', 'order' => 1],
                ['name' => 'CO2 laser marking system', 'order' => 2],
                ['name' => 'OPP Hot Melt Labeling Machine', 'order' => 3],
                ['name' => 'Film packing system + Air conveyor', 'order' => 4],
            ],
            'modal_title' => 'Blowing Machine GY-GB-4SS',
            'modal_subtitle' => 'Automatic bottle blowing dengan 3 servo motors presisi tinggi',
            'modal_description' => 'Mesin blowing otomatis dengan teknologi servo motor triple untuk presisi maksimal dalam produksi botol. Dilengkapi dengan sistem kontrol PLC dan sensor keamanan.',
            'whatsapp_message' => 'Halo, saya ingin tanya tentang Blowing Machine AROMAS',
            'order' => 1,
            'is_active' => true,
        ]);

        // MACHINE 2: Filling & Capping (category_id = 2)
        Machine::create([
            'category_id' => 2,
            'name' => 'RGF24-8 Filling & Capping',
            'tagline' => 'Mesin filling dan capping otomatis kapasitas tinggi untuk botol PET',
            'unit_count' => 2,
            'capacity_badge' => '12.000 BPH',
            'images' => [
                ['url' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=700&h=440&fit=crop', 'order' => 0, 'is_primary' => true],
                ['url' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=700&h=440&fit=crop', 'order' => 1, 'is_primary' => false],
            ],
            'specs' => [
                ['label' => 'Filling Heads', 'value' => '24-head rotary', 'order' => 1],
                ['label' => 'Capping Heads', 'value' => '8-head automatic', 'order' => 2],
                ['label' => 'Accuracy', 'value' => '±0.5% (gravimetri)', 'order' => 3],
            ],
            'components' => [
                ['name' => '24-head rotary filling system', 'order' => 1],
                ['name' => '8-head automatic capping', 'order' => 2],
                ['name' => 'Akurasi filling ±0.5% (gravimetri)', 'order' => 3],
                ['name' => 'Compatible botol 200ml – 2.000ml', 'order' => 4],
                ['name' => 'CIP (Clean-In-Place) system', 'order' => 5],
            ],
            'modal_title' => 'RGF24-8 Filling & Capping',
            'modal_subtitle' => 'Mesin filling dan capping otomatis kapasitas tinggi untuk botol PET',
            'modal_description' => 'Sistem filling dan capping terintegrasi dengan 24 head filling dan 8 head capping untuk efisiensi maksimal. Dilengkapi sistem CIP untuk pembersihan mudah.',
            'whatsapp_message' => 'Halo, saya ingin tanya tentang Filling Machine AROMAS',
            'order' => 2,
            'is_active' => true,
        ]);

        // MACHINE 3: OPP Labeling (category_id = 3)
        Machine::create([
            'category_id' => 3,
            'name' => 'OPP Hot Melt Labeling Machine',
            'tagline' => 'Sistem labeling presisi tinggi berbasis hot melt adhesive',
            'unit_count' => 1,
            'capacity_badge' => '12.000 BPH',
            'images' => [
                ['url' => 'https://images.unsplash.com/photo-1601924994987-69e26d50dc26?w=700&h=440&fit=crop', 'order' => 0, 'is_primary' => true],
                ['url' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=700&h=440&fit=crop', 'order' => 1, 'is_primary' => false],
            ],
            'specs' => [
                ['label' => 'Label Type', 'value' => 'OPP (Oriented Polypropylene)', 'order' => 1],
                ['label' => 'Adhesive', 'value' => 'Hot melt adhesive', 'order' => 2],
                ['label' => 'Accuracy', 'value' => '±0.5mm', 'order' => 3],
            ],
            'components' => [
                ['name' => 'OPP (Oriented Polypropylene) label', 'order' => 1],
                ['name' => 'Hot melt adhesive application', 'order' => 2],
                ['name' => 'Akurasi posisi label ±0.5mm', 'order' => 3],
                ['name' => 'Sistem deteksi label otomatis', 'order' => 4],
            ],
            'modal_title' => 'OPP Hot Melt Labeling Machine',
            'modal_subtitle' => 'Sistem labeling presisi tinggi berbasis hot melt adhesive',
            'modal_description' => 'Mesin labeling otomatis dengan teknologi hot melt adhesive untuk hasil labeling yang rapi dan tahan lama. Dilengkapi sensor deteksi label otomatis.',
            'whatsapp_message' => 'Halo, saya ingin tanya tentang Labeling Machine AROMAS',
            'order' => 3,
            'is_active' => true,
        ]);

        // MACHINE 4: Packaging (category_id = 4)
        Machine::create([
            'category_id' => 4,
            'name' => 'Automatic Case Packer',
            'tagline' => 'Sistem packaging otomatis untuk efisiensi produksi maksimal',
            'unit_count' => 1,
            'capacity_badge' => '24 Cases/Min',
            'images' => [
                ['url' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=700&h=440&fit=crop', 'order' => 0, 'is_primary' => true],
                ['url' => 'https://images.unsplash.com/photo-1553413077-190dd305871c?w=700&h=440&fit=crop', 'order' => 1, 'is_primary' => false],
            ],
            'specs' => [
                ['label' => 'Speed', 'value' => '24 cases/min', 'order' => 1],
                ['label' => 'Box Size', 'value' => 'Adjustable', 'order' => 2],
                ['label' => 'Control', 'value' => 'PLC + HMI', 'order' => 3],
            ],
            'components' => [
                ['name' => 'Automatic box forming', 'order' => 1],
                ['name' => 'Product loading system', 'order' => 2],
                ['name' => 'Box sealing system', 'order' => 3],
                ['name' => 'PLC control panel', 'order' => 4],
            ],
            'modal_title' => 'Automatic Case Packer',
            'modal_subtitle' => 'Sistem packaging otomatis untuk efisiensi produksi maksimal',
            'modal_description' => 'Mesin packaging otomatis yang mengintegrasikan box forming, product loading, dan box sealing dalam satu sistem terpadu.',
            'whatsapp_message' => 'Halo, saya ingin tanya tentang Packaging Machine AROMAS',
            'order' => 4,
            'is_active' => true,
        ]);

        // MACHINE 5: Conveyor (category_id = 5)
        Machine::create([
            'category_id' => 5,
            'name' => 'Air Conveyor System',
            'tagline' => 'Sistem conveyor berbasis udara untuk transportasi botol yang higienis',
            'unit_count' => 1,
            'capacity_badge' => 'Custom Length',
            'images' => [
                ['url' => 'https://images.unsplash.com/photo-1504917595277-f5d6038842b3?w=700&h=440&fit=crop', 'order' => 0, 'is_primary' => true],
                ['url' => 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=700&h=440&fit=crop', 'order' => 1, 'is_primary' => false],
            ],
            'specs' => [
                ['label' => 'Type', 'value' => 'Air conveyor', 'order' => 1],
                ['label' => 'Material', 'value' => 'Stainless Steel 304', 'order' => 2],
                ['label' => 'Length', 'value' => 'Custom', 'order' => 3],
            ],
            'components' => [
                ['name' => 'Air blower system', 'order' => 1],
                ['name' => 'Stainless steel frame', 'order' => 2],
                ['name' => 'Variable speed control', 'order' => 3],
                ['name' => 'Bottle guide rails', 'order' => 4],
            ],
            'modal_title' => 'Air Conveyor System',
            'modal_subtitle' => 'Sistem conveyor berbasis udara untuk transportasi botol yang higienis',
            'modal_description' => 'Sistem conveyor yang menggunakan tekanan udara untuk memindahkan botol dengan lembut dan higienis. Cocok untuk industri makanan dan minuman.',
            'whatsapp_message' => 'Halo, saya ingin tanya tentang Conveyor System AROMAS',
            'order' => 5,
            'is_active' => true,
        ]);

        // MACHINE 6: Refinery (category_id = 6)
        Machine::create([
            'category_id' => 6,
            'name' => 'CPO Refinery Plant',
            'tagline' => 'Pabrik penyulingan CPO kapasitas 50 ton per hari',
            'unit_count' => 1,
            'capacity_badge' => '50 T/Hari',
            'images' => [
                ['url' => 'https://images.unsplash.com/photo-1590247813693-5541d1c609fd?w=700&h=440&fit=crop', 'order' => 0, 'is_primary' => true],
                ['url' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=700&h=440&fit=crop', 'order' => 1, 'is_primary' => false],
            ],
            'specs' => [
                ['label' => 'Capacity', 'value' => '50 Ton/hari', 'order' => 1],
                ['label' => 'Process', 'value' => 'Physical Refining', 'order' => 2],
                ['label' => 'Certification', 'value' => 'ISO 22000:2018', 'order' => 3],
            ],
            'components' => [
                ['name' => 'Degumming system', 'order' => 1],
                ['name' => 'Bleaching system', 'order' => 2],
                ['name' => 'Deodorizing system', 'order' => 3],
                ['name' => 'Fractionation system', 'order' => 4],
                ['name' => 'Quality control lab', 'order' => 5],
            ],
            'modal_title' => 'CPO Refinery Plant',
            'modal_subtitle' => 'Pabrik penyulingan CPO kapasitas 50 ton per hari',
            'modal_description' => 'Pabrik penyulingan CPO modern dengan kapasitas 50 ton per hari. Menggunakan proses physical refining untuk menghasilkan minyak goreng berkualitas tinggi dengan sertifikasi ISO 22000:2018.',
            'whatsapp_message' => 'Halo, saya ingin tanya tentang Refinery Plant AROMAS',
            'order' => 6,
            'is_active' => true,
        ]);

        // MACHINE 7: Laser Coding (category_id = 4 - Packaging)
        Machine::create([
            'category_id' => 4,
            'name' => 'CO2 Laser Coding Machine',
            'tagline' => 'Sistem coding dan marking berbasis laser CO2',
            'unit_count' => 1,
            'capacity_badge' => 'High Speed',
            'images' => [
                ['url' => 'https://images.unsplash.com/photo-1565043589221-1a6fd9ae45c7?w=700&h=440&fit=crop', 'order' => 0, 'is_primary' => true],
                ['url' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=700&h=440&fit=crop', 'order' => 1, 'is_primary' => false],
            ],
            'specs' => [
                ['label' => 'Type', 'value' => 'CO2 Laser', 'order' => 1],
                ['label' => 'Speed', 'value' => 'High speed', 'order' => 2],
                ['label' => 'Marking', 'value' => 'Permanent', 'order' => 3],
            ],
            'components' => [
                ['name' => 'CO2 laser source', 'order' => 1],
                ['name' => 'Galvanometer scanner', 'order' => 2],
                ['name' => 'Control software', 'order' => 3],
                ['name' => 'Conveyor integration', 'order' => 4],
            ],
            'modal_title' => 'CO2 Laser Coding Machine',
            'modal_subtitle' => 'Sistem coding dan marking berbasis laser CO2',
            'modal_description' => 'Mesin coding dan marking menggunakan teknologi laser CO2 untuk hasil yang permanen dan presisi. Cocok untuk marking tanggal kadaluarsa dan batch number.',
            'whatsapp_message' => 'Halo, saya ingin tanya tentang Laser Coding Machine AROMAS',
            'order' => 7,
            'is_active' => true,
        ]);

        // MACHINE 8: Water Treatment (category_id = 6 - Refinery)
        Machine::create([
            'category_id' => 6,
            'name' => 'Water Treatment Plant',
            'tagline' => 'Sistem pengolahan air untuk kebutuhan produksi',
            'unit_count' => 1,
            'capacity_badge' => '10.000 L/Hari',
            'images' => [
                ['url' => 'https://images.unsplash.com/photo-1521633603176-161e178a92f9?w=700&h=440&fit=crop', 'order' => 0, 'is_primary' => true],
                ['url' => 'https://images.unsplash.com/photo-1581093583449-ed25213444e6?w=700&h=440&fit=crop', 'order' => 1, 'is_primary' => false],
            ],
            'specs' => [
                ['label' => 'Capacity', 'value' => '10.000 Liter/hari', 'order' => 1],
                ['label' => 'Process', 'value' => 'RO + UV', 'order' => 2],
                ['label' => 'Quality', 'value' => 'Food Grade', 'order' => 3],
            ],
            'components' => [
                ['name' => 'Reverse Osmosis system', 'order' => 1],
                ['name' => 'UV sterilization', 'order' => 2],
                ['name' => 'Carbon filtration', 'order' => 3],
                ['name' => 'Storage tanks', 'order' => 4],
            ],
            'modal_title' => 'Water Treatment Plant',
            'modal_subtitle' => 'Sistem pengolahan air untuk kebutuhan produksi',
            'modal_description' => 'Sistem pengolahan air modern dengan teknologi Reverse Osmosis dan UV sterilization untuk menghasilkan air berkualitas food grade.',
            'whatsapp_message' => 'Halo, saya ingin tanya tentang Water Treatment Plant AROMAS',
            'order' => 8,
            'is_active' => true,
        ]);
    }
}
