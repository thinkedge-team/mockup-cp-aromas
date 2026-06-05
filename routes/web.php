<?php

use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PortfolioController;
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

Route::get('/distributor', function () {
    return view('distributor');
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

Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');

Route::get('/partnership', function () {
    return view('partnership');
});

Route::post('/contact/send', [ContactFormController::class, 'send'])
    ->name('contact.send')
    ->middleware('throttle:contact-form');
