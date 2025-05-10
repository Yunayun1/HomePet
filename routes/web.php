<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public Pages
Route::get('/', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/Adopt', function () {
    return view('Adopt');
});

Route::get('/Search', function () {
    return view('Search');
});

Route::get('/blog-single', function () {
    return view('blog-single');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/gallery', function () {
    return view('gallery');
});

Route::get('/main', function () {
    return view('main');
});

Route::get('/pricing', function () {
    return view('pricing');
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/vet', function () {
    return view('vet');
});

Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest');

// Auth Routes
Auth::routes();

// After Login Redirect
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
