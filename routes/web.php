<?php

use App\Http\Controllers\BlogController;
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

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/search', [BlogController::class, 'search'])->name('blog.search');
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/tag/{slug}', [BlogController::class, 'tag'])->name('blog.tag');
Route::post('/blog/comment', [BlogController::class, 'submitComment'])->name('blog.comment.submit');
Route::post('/blog/post/{id}/like', [BlogController::class, 'likePost'])->name('blog.post.like');
Route::post('/blog/comment/{id}/like', [BlogController::class, 'likeComment'])->name('blog.comment.like');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/portfolio', function () {
    return view('portfolio');
});

Route::get('/partnership', function () {
    return view('partnership');
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
