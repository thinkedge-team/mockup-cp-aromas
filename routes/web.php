<?php

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

Route::get('/promo', function () {
    return view('promo');
});

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
