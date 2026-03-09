<?php

namespace Database\Seeders;

use App\Models\BlogAuthor;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BlogPost;
use App\Models\BlogSetting;
use App\Models\BlogTag;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Categories
        $categories = [
            ['name' => 'Tips Memasak', 'slug' => 'tips-memasak', 'icon' => 'bi-lightbulb-fill', 'sort_order' => 0],
            ['name' => 'Resep', 'slug' => 'resep', 'icon' => 'bi-book-fill', 'sort_order' => 1],
            ['name' => 'Edukasi', 'slug' => 'edukasi', 'icon' => 'bi-mortarboard-fill', 'sort_order' => 2],
            ['name' => 'Industri', 'slug' => 'industri', 'icon' => 'bi-building-fill', 'sort_order' => 3],
        ];

        foreach ($categories as $category) {
            BlogCategory::create($category);
        }

        // Create Tags
        $tags = [
            ['name' => 'Minyak Goreng', 'slug' => 'minyak-goreng'],
            ['name' => 'Kesehatan', 'slug' => 'kesehatan'],
            ['name' => 'Resep', 'slug' => 'resep-tag'],
            ['name' => 'Gorengan', 'slug' => 'gorengan'],
            ['name' => 'Sawit', 'slug' => 'sawit'],
            ['name' => 'Dapur', 'slug' => 'dapur'],
            ['name' => 'AROMAS', 'slug' => 'aromas'],
            ['name' => 'Nutrisi', 'slug' => 'nutrisi'],
            ['name' => 'Industri', 'slug' => 'industri-tag'],
            ['name' => 'Tips', 'slug' => 'tips'],
        ];

        foreach ($tags as $tag) {
            BlogTag::create($tag);
        }

        // Create Authors
        $authors = [
            [
                'name' => 'dr. Sari Nutritionist, M.Gizi',
                'slug' => 'dr-sari-nutritionist',
                'initials' => 'S',
                'role' => 'Ahli Gizi Klinis · AROMAS Health Advisory Board',
                'bio' => 'Dokter spesialis gizi klinis dengan pengalaman 12 tahun di bidang keamanan pangan dan nutrisi keluarga. Aktif berkontribusi sebagai penulis di berbagai jurnal kesehatan nasional dan internasional. Bergabung dengan AROMAS sebagai konsultan kesehatan sejak 2022.',
                'instagram' => '@drisarinutrition',
                'linkedin' => 'linkedin.com/in/dr-sari-nutritionist',
                'twitter' => '@drisarinutri',
            ],
            [
                'name' => 'Chef Budi Santoso',
                'slug' => 'chef-budi-santoso',
                'initials' => 'B',
                'role' => 'Executive Chef · Culinary Consultant',
                'bio' => 'Chef profesional dengan pengalaman 20 tahun di industri kuliner. Spesialisasi dalam masakan Indonesia tradisional dan modern. Konsultan kuliner untuk AROMAS sejak 2021.',
                'instagram' => '@chefbudi',
                'linkedin' => 'linkedin.com/in/chef-budi-santoso',
            ],
            [
                'name' => 'Tim AROMAS',
                'slug' => 'tim-aromas',
                'initials' => 'A',
                'role' => 'AROMAS Editorial Team',
                'bio' => 'Tim editorial AROMAS yang berdedikasi untuk memberikan informasi terbaik seputar produk, kesehatan, dan kuliner.',
                'is_active' => true,
            ],
        ];

        foreach ($authors as $author) {
            BlogAuthor::create($author);
        }

        // Create Blog Settings
        BlogSetting::create([
            'badge_text' => 'Blog & Artikel Resmi',
            'title' => 'Tips, Resep & Edukasi',
            'title_emphasis' => 'Seputar Memasak',
            'description' => 'Inspirasi memasak, tips memilih minyak goreng yang sehat, resep lezat, dan edukasi seputar industri sawit dari para ahli AROMAS.',
            'stats' => [
                ['number' => '24+', 'label' => 'Artikel', 'order' => 0],
                ['number' => '4', 'label' => 'Kategori', 'order' => 1],
                ['number' => '12K+', 'label' => 'Pembaca', 'order' => 2],
            ],
            'meta_title' => 'Blog AROMAS - Tips, Resep & Edukasi Memasak',
            'meta_description' => 'Baca artikel terbaru tentang tips memasak, resep lezat, dan edukasi kesehatan dari para ahli AROMAS.',
            'is_active' => true,
        ]);

        // Create Sample Posts
        $posts = [
            [
                'category_id' => 1,
                'author_id' => 1,
                'title' => 'Cara Memilih Minyak Goreng yang Sehat untuk Keluarga: Panduan Lengkap dari Ahli Gizi',
                'slug' => 'cara-memilih-minyak-goreng-sehat',
                'excerpt' => 'Tidak semua minyak goreng sama. Pelajari cara memilih minyak goreng yang tepat berdasarkan titik asap, kandungan lemak, sertifikasi, dan teknik memasak — agar masakan lebih sehat dan lezat setiap hari.',
                'content' => $this->getSampleContent1(),
                'featured_image' => 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=900&h=600&fit=crop',
                'tags' => ['minyak-goreng', 'kesehatan', 'tips', 'nutrisi'],
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(15),
                'reading_time' => 7,
                'view_count' => 3200,
                'like_count' => 248,
                'seo_title' => 'Cara Memilih Minyak Goreng Sehat - Panduan Ahli Gizi',
                'seo_description' => 'Panduan lengkap memilih minyak goreng sehat untuk keluarga. Pelajari tentang titik asap, kandungan nutrisi, dan sertifikasi dari ahli gizi.',
                'seo_keywords' => 'minyak goreng sehat, tips memilih minyak, titik asap, kesehatan keluarga, AROMAS',
            ],
            [
                'category_id' => 2,
                'author_id' => 2,
                'title' => '5 Resep Gorengan Crispy yang Wajib Dicoba di Rumah',
                'slug' => '5-resep-gorengan-crispy',
                'excerpt' => 'Gorengan adalah camilan favorit keluarga Indonesia. Berikut 5 resep gorengan crispy yang mudah dibuat di rumah dengan hasil sempurna setiap kali.',
                'content' => $this->getSampleContent2(),
                'featured_image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=900&h=600&fit=crop',
                'tags' => ['resep', 'gorengan', 'dapur', 'aromas'],
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(8),
                'reading_time' => 5,
                'view_count' => 1850,
                'like_count' => 156,
            ],
            [
                'category_id' => 3,
                'author_id' => 1,
                'title' => 'Fakta Menarik Tentang Minyak Kelapa Sawit Indonesia',
                'slug' => 'fakta-minyak-kelapa-sawit-indonesia',
                'excerpt' => 'Indonesia adalah produsen minyak kelapa sawit terbesar di dunia. Ketahui fakta-fakta menarik tentang industri sawit nasional dan kontribusinya.',
                'content' => $this->getSampleContent3(),
                'featured_image' => 'https://images.unsplash.com/photo-1466637574441-749b8f19452f?w=900&h=600&fit=crop',
                'tags' => ['sawit', 'industri', 'aromas'],
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(20),
                'reading_time' => 6,
                'view_count' => 2100,
                'like_count' => 189,
            ],
            [
                'category_id' => 1,
                'author_id' => 3,
                'title' => '7 Rahasia Menggoreng Crispy Sempurna yang Sering Dilupakan',
                'slug' => '7-rahasia-menggoreng-crispy',
                'excerpt' => 'Menggoreng terlihat mudah, tapi ada teknik khusus untuk hasil crispy sempurna. Simak 7 rahasia yang sering dilupakan ini.',
                'content' => $this->getSampleContent4(),
                'featured_image' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=900&h=600&fit=crop',
                'tags' => ['tips', 'gorengan', 'dapur'],
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'reading_time' => 4,
                'view_count' => 980,
                'like_count' => 87,
            ],
            [
                'category_id' => 3,
                'author_id' => 1,
                'title' => 'Vitamin E dalam Minyak Goreng Sawit: Manfaat Nyata untuk Tubuh',
                'slug' => 'vitamin-e-minyak-sawit',
                'excerpt' => 'Minyak sawit kaya akan Vitamin E dan tokotrienol. Ketahui manfaat nyata antioksidan alami ini untuk kesehatan tubuh Anda.',
                'content' => $this->getSampleContent5(),
                'featured_image' => 'https://images.unsplash.com/photo-1543352634-99a5d50ae78e?w=900&h=600&fit=crop',
                'tags' => ['kesehatan', 'nutrisi', 'sawit'],
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(30),
                'reading_time' => 6,
                'view_count' => 1560,
                'like_count' => 134,
            ],
            [
                'category_id' => 1,
                'author_id' => 2,
                'title' => 'Benarkah Minyak Sawit Berbahaya untuk Jantung? Penjelasan Ilmiahnya',
                'slug' => 'minyak-sawit-kesehatan-jantung',
                'excerpt' => 'Banyak mitos beredar tentang minyak sawit dan kesehatan jantung. Mari kita lihat penjelasan ilmiah dari para ahli.',
                'content' => $this->getSampleContent6(),
                'featured_image' => 'https://images.unsplash.com/photo-1590779033100-9f60a05a013d?w=900&h=600&fit=crop',
                'tags' => ['kesehatan', 'minyak-goreng', 'nutrisi'],
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(12),
                'reading_time' => 8,
                'view_count' => 2450,
                'like_count' => 201,
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::create($post);
        }

        // Create Sample Comments
        $comments = [
            [
                'post_id' => 1,
                'author_name' => 'Budi Santoso',
                'author_email' => 'budi@example.com',
                'content' => 'Artikel yang sangat informatif! Selama ini saya hanya lihat harga tanpa perhatikan titik asap. Langsung cek label kemasan AROMAS di rumah dan ternyata sudah memenuhi semua kriteria. Makasih dr. Sari!',
                'is_approved' => true,
                'is_verified' => true,
                'is_official' => false,
                'likes' => 24,
                'created_at' => now()->subDays(14),
            ],
            [
                'post_id' => 1,
                'parent_id' => 1,
                'author_name' => 'Tim AROMAS',
                'author_email' => 'info@aromas.co.id',
                'content' => 'Terima kasih, Pak Budi! Senang bisa membantu. Semua produk AROMAS dirancang dengan memperhatikan kebutuhan kesehatan konsumen. Jangan ragu menghubungi kami jika ada pertanyaan lanjutan. 🌿',
                'is_approved' => true,
                'is_verified' => false,
                'is_official' => true,
                'likes' => 12,
                'created_at' => now()->subDays(14),
            ],
            [
                'post_id' => 1,
                'author_name' => 'Rahma Dewi',
                'author_email' => 'rahma@example.com',
                'content' => 'Bagian tabel perbandingannya sangat membantu! Baru tahu kalau minyak zaitun titik asapnya rendah. Selama ini saya salah kaprah menggunakannya untuk menggoreng 😅',
                'is_approved' => true,
                'is_verified' => false,
                'is_official' => false,
                'likes' => 18,
                'created_at' => now()->subDays(13),
            ],
            [
                'post_id' => 1,
                'author_name' => 'Agus Prasetyo',
                'author_email' => 'agus@example.com',
                'content' => 'Sudah pakai AROMAS sejak 2 tahun lalu, kualitasnya konsisten. Minyaknya bening, tidak cepat hitam, dan aromanya netral jadi tidak mengubah cita rasa masakan. Highly recommended!',
                'is_approved' => true,
                'is_verified' => false,
                'is_official' => false,
                'likes' => 31,
                'created_at' => now()->subDays(12),
            ],
        ];

        foreach ($comments as $comment) {
            BlogComment::create($comment);
        }
    }

    private function getSampleContent1()
    {
        return '<p>Memilih minyak goreng yang tepat bukan sekadar soal harga atau merek — ini adalah keputusan yang berdampak langsung pada kesehatan seluruh keluarga setiap hari. Dengan begitu banyak pilihan di rak supermarket, banyak konsumen yang bingung harus memilih yang mana.</p>
<p>Dalam panduan ini, kami membahas secara tuntas apa yang benar-benar perlu Anda perhatikan saat memilih minyak goreng — dari kandungan nutrisi, titik asap, hingga sertifikasi resmi yang menjamin keamanan produk.</p>

<div class="callout info">
<div class="callout-icon"><i class="bi bi-info-circle-fill"></i></div>
<div class="callout-body">
<div class="callout-title">Tahukah Anda?</div>
<p class="callout-text">Rata-rata orang Indonesia mengonsumsi 15–20 liter minyak goreng per tahun. Memilih produk yang tepat bisa membuat perbedaan signifikan pada kesehatan jangka panjang seluruh keluarga.</p>
</div>
</div>

<h2 id="h-1">1. Pahami Jenis-Jenis Minyak Goreng</h2>
<p>Di Indonesia, minyak goreng yang paling umum digunakan adalah <strong>minyak kelapa sawit</strong>. Setiap jenis minyak memiliki karakteristik berbeda yang perlu dipertimbangkan:</p>

<div class="compare-wrap">
<table class="compare-table">
<thead>
<tr><th>Jenis Minyak</th><th>Titik Asap</th><th>Lemak Jenuh</th><th>Cocok Untuk</th></tr>
</thead>
<tbody>
<tr><td>Minyak Sawit (AROMAS)</td><td class="tc-good">215°C</td><td><span class="badge-pill green">Sedang</span></td><td>Semua teknik memasak</td></tr>
<tr><td>Minyak Kelapa</td><td>177°C</td><td><span class="badge-pill gold">Tinggi</span></td><td>Tumis, panggang</td></tr>
<tr><td>Minyak Jagung</td><td class="tc-good">230°C</td><td><span class="badge-pill green">Rendah</span></td><td>Goreng, tumis</td></tr>
<tr><td>Minyak Zaitun</td><td class="tc-warn">160–190°C</td><td><span class="badge-pill green">Sangat Rendah</span></td><td>Salad, tumis ringan</td></tr>
</tbody>
</table>
</div>

<h2 id="h-2">2. Perhatikan Titik Asap (Smoke Point)</h2>
<p>Titik asap adalah suhu ketika minyak mulai mengeluarkan asap dan terurai secara kimia. Menggunakan minyak di atas titik asapnya menghasilkan senyawa berbahaya seperti <strong>aldehida dan akrolein</strong> yang dapat merusak kesehatan.</p>

<div class="pull-quote">
<p>"Semakin tinggi titik asap sebuah minyak goreng, semakin aman dan stabil minyak tersebut untuk teknik memasak bersuhu tinggi seperti menggoreng dalam minyak banyak."</p>
<cite>dr. Sari Nutritionist, Ahli Gizi Klinis</cite>
</div>

<p>Untuk aktivitas menggoreng harian seperti ayam goreng, tempe goreng, atau gorengan lainnya, pilihlah minyak dengan titik asap di atas 200°C. Minyak goreng sawit berkualitas seperti AROMAS memiliki titik asap sekitar 215°C — sangat ideal untuk berbagai teknik memasak.</p>

<h2 id="h-3">3. Cek Kandungan Lemak & Nutrisi</h2>
<p>Label nutrisi pada kemasan minyak goreng wajib Anda baca sebelum membeli. Ini yang perlu dicermati:</p>
<ul>
<li><strong>Lemak jenuh (saturated fat)</strong> — pilih yang kandungannya lebih rendah untuk kesehatan jantung jangka panjang.</li>
<li><strong>Lemak tak jenuh tunggal (MUFA)</strong> — jenis lemak baik yang membantu menjaga kadar kolesterol HDL.</li>
<li><strong>Lemak tak jenuh ganda (PUFA)</strong> — termasuk omega-3 dan omega-6 yang penting untuk otak dan imunitas.</li>
<li><strong>Vitamin E (tokoferol)</strong> — antioksidan alami yang membantu melindungi sel dari kerusakan oksidatif.</li>
<li><strong>Kolesterol</strong> — minyak nabati idealnya bebas kolesterol. Pastikan label mencantumkan "0 mg kolesterol".</li>
</ul>

<h2 id="h-4">4. Pastikan Ada Sertifikasi Resmi</h2>
<p>Ini adalah langkah krusial yang sering diabaikan. Produk minyak goreng berkualitas harus memiliki setidaknya:</p>
<ol>
<li><strong>Izin Edar BPOM RI</strong> — bukti produk telah melalui uji keamanan pangan Badan Pengawas Obat dan Makanan.</li>
<li><strong>Sertifikasi Halal MUI</strong> — jaminan produk memenuhi standar kehalalan Majelis Ulama Indonesia.</li>
<li><strong>Standar Nasional Indonesia (SNI)</strong> — produk memenuhi standar mutu nasional yang berlaku.</li>
<li><strong>ISO 22000 (nilai tambah)</strong> — sistem manajemen keamanan pangan bertaraf internasional.</li>
</ol>

<div class="callout success">
<div class="callout-icon"><i class="bi bi-patch-check-fill"></i></div>
<div class="callout-body">
<div class="callout-title">AROMAS Sudah Tersertifikasi</div>
<p class="callout-text">Semua produk AROMAS telah mendapatkan izin BPOM RI, Sertifikat Halal MUI, dan SNI — sehingga aman dan terjamin kualitasnya untuk seluruh keluarga.</p>
</div>
</div>

<div class="takeaways">
<div class="takeaways-header"><i class="bi bi-bookmark-star-fill"></i><span>Ringkasan — Simpan Ini!</span></div>
<div class="takeaways-body">
<div class="takeaway-row"><div class="takeaway-num">1</div><span>Pilih minyak dengan titik asap minimal 200°C untuk penggorengan yang aman dan sehat.</span></div>
<div class="takeaway-row"><div class="takeaway-num">2</div><span>Baca label nutrisi — utamakan rendah lemak jenuh dan kaya Vitamin E alami.</span></div>
<div class="takeaway-row"><div class="takeaway-num">3</div><span>Wajib ada sertifikasi BPOM RI dan Halal MUI yang tercetak jelas di kemasan.</span></div>
<div class="takeaway-row"><div class="takeaway-num">4</div><span>Perhatikan warna, aroma, dan konsistensi minyak sebelum digunakan memasak.</span></div>
<div class="takeaway-row"><div class="takeaway-num">5</div><span>Simpan di tempat sejuk, gelap, dan tutup rapat setelah setiap pemakaian.</span></div>
</div>
</div>

<p>Dengan menerapkan panduan ini, Anda dapat membuat keputusan pembelian yang lebih cerdas demi kesehatan keluarga. Minyak goreng AROMAS hadir sebagai pilihan yang memenuhi semua kriteria di atas — jernih, bersertifikat, dan kaya Vitamin E alami.</p>';
    }

    private function getSampleContent2()
    {
        return '<p>Gorengan adalah camilan favorit keluarga Indonesia. Berikut 5 resep gorengan crispy yang mudah dibuat di rumah dengan hasil sempurna setiap kali.</p>
<h2 id="h-1">1. Bakwan Sayur Crispy</h2>
<p>Bahan-bahan yang dibutuhkan...</p>
<h2 id="h-2">2. Tahu Isi Crispy</h2>
<p>Resep tahu isi dengan kulit yang renyah...</p>
<h2 id="h-3">3. Tempe Mendoan</h2>
<p>Tempe mendoan khas Banyumas...</p>
<h2 id="h-4">4. Pisang Goreng Crispy</h2>
<p>Pisang goreng dengan tepung khusus...</p>
<h2 id="h-5">5. Ubi Goreng Crispy</h2>
<p>Ubi jalar goreng dengan bumbu tabur...</p>
<p>Selamat mencoba di rumah!</p>';
    }

    private function getSampleContent3()
    {
        return '<p>Indonesia adalah produsen minyak kelapa sawit terbesar di dunia. Ketahui fakta-fakta menarik tentang industri sawit nasional dan kontribusinya.</p>
<h2 id="h-1">1. Produsen Terbesar Dunia</h2>
<p>Indonesia menyumbang lebih dari 50% produksi minyak sawit dunia...</p>
<h2 id="h-2">2. Kontribusi Ekonomi</h2>
<p>Industri sawit menyerap jutaan tenaga kerja...</p>
<h2 id="h-3">3. Keberlanjutan</h2>
<p>Program ISPO dan RSPO untuk sawit berkelanjutan...</p>';
    }

    private function getSampleContent4()
    {
        return '<p>Menggoreng terlihat mudah, tapi ada teknik khusus untuk hasil crispy sempurna. Simak 7 rahasia yang sering dilupakan ini.</p>
<h2 id="h-1">1. Suhu Minyak yang Tepat</h2>
<p>Pastikan minyak sudah cukup panas sebelum menggoreng...</p>
<h2 id="h-2">2. Jangan Terlalu Banyak Menggoreng</h2>
<p>Jangan memenuhi wajan dengan terlalu banyak makanan...</p>
<h2 id="h-3">3. Gunakan Tepung yang Tepat</h2>
<p>Kombinasi tepung terigu dan tepung beras...</p>';
    }

    private function getSampleContent5()
    {
        return '<p>Minyak sawit kaya akan Vitamin E dan tokotrienol. Ketahui manfaat nyata antioksidan alami ini untuk kesehatan tubuh Anda.</p>
<h2 id="h-1">Apa Itu Vitamin E?</h2>
<p>Vitamin E adalah antioksidan yang larut dalam lemak...</p>
<h2 id="h-2">Manfaat untuk Kesehatan</h2>
<p>Vitamin E membantu melindungi sel dari kerusakan...</p>
<h2 id="h-3">Tokotrienol dalam Sawit</h2>
<p>Minyak sawit adalah salah satu sumber terbaik tokotrienol...</p>';
    }

    private function getSampleContent6()
    {
        return '<p>Banyak mitos beredar tentang minyak sawit dan kesehatan jantung. Mari kita lihat penjelasan ilmiah dari para ahli.</p>
<h2 id="h-1">Mitos vs Fakta</h2>
<p>Beberapa mitos yang beredar tentang minyak sawit...</p>
<h2 id="h-2">Penelitian Terbaru</h2>
<p>Studi-studi terbaru menunjukkan...</p>
<h2 id="h-3">Kesimpulan</h2>
<p>Minyak sawit dalam jumlah wajar aman dikonsumsi...</p>';
    }
}
