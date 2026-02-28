<?php

use App\Http\Controllers\PromoPageController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/product', function () {
    return view('product');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/our-machine', function () {
    return view('our-machine');
});

Route::get('/promo', [PromoPageController::class, 'index'])->name('promo');

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/portfolio', function () {
    return view('portfolio');
});

Route::get('/partnership', function () {
    return view('partnership');
});

Route::get('/blog/cara-memilih-minyak-goreng-sehat', function () {
    return view('blog-detail');
});

Route::post('/contact/send', function (\Illuminate\Http\Request $request) {
    try {
        $validated = $request->validate([
            'subject' => 'required|string',
            'name'    => 'required|string',
            'company' => 'nullable|string',
            'email'   => 'required|email',
            'phone'   => 'required|string',
            'product' => 'nullable|string',
            'volume'  => 'nullable|string',
            'city'    => 'required|string',
            'message' => 'required|string',
            'files.*' => 'nullable|file|max:5120', // 5MB max
        ]);

        $adminEmail = env('MAIL_TO_ADDRESS', 'info@aromas.co.id');
        
        \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\ContactFormMail($validated));

        return response()->json(['success' => true, 'message' => 'Pesan berhasil terkirim']);
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Contact Form Error: ' . $e->getMessage());
        return response()->json([
            'success' => false, 
            'message' => 'Mohon maaf, saat ini sistem gagal mengirimkan pesan Anda karena gangguan server. Silakan hubungi kami langsung melalui tombol WhatsApp.'
        ], 500);
    }
})->name('contact.send');
