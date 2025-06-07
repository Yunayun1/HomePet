<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GoogleController;

// 🌐 Public Pages
Route::view('/', 'index');
Route::view('/about', 'about');
Route::view('/blog', 'blog');
Route::view('/Adopt', 'Adopt');
Route::view('/Search', 'Search');
Route::view('/blog-single', 'blog-single');
Route::view('/contact', 'contact');
Route::view('/gallery', 'gallery');
Route::view('/main', 'main');
Route::view('/pricing', 'pricing');
Route::view('/services', 'services');
Route::view('/vet', 'vet');

//  Auth Routes (Login, Register, etc.)
Auth::routes();

//  After login/register redirect here
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('auth');

// Google Login Routes
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
