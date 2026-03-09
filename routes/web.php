<?php

use App\Http\Controllers\ContactFormController;
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

Route::post('/contact/send', [ContactFormController::class, 'send'])
    ->name('contact.send')
    ->middleware('throttle:contact-form');
