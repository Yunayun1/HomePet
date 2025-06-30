<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ShelterController;
use App\Http\Controllers\Admin\AdoptionController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\User;
use App\Http\Controllers\Admin\ManagePetController;
use App\Http\Controllers\Auth\OtpController;

// Public Pages (require auth)
Route::view('/', 'index')->name('home');
Route::view('/about', 'about');
Route::view('/blog', 'blog');
Route::view('/Adopt', 'Adopt');
Route::view('/blog-single', 'blog-single');
Route::view('/contact', 'contact');
Route::view('/gallery', 'gallery');
Route::view('/main', 'main');
Route::view('/pricing', 'pricing');
Route::view('/services', 'services');
Route::view('/vet', 'vet');

//Admin routes group
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::match(['post', 'put'], 'users/{user}/ban', [UserController::class, 'ban'])->name('users.ban');
    Route::post('users/{user}/unban', [UserController::class, 'unban'])->name('users.unban');
    Route::resource('adoptions', AdoptionController::class);
    Route::resource('shelters', ShelterController::class)->middleware('auth');
    Route::put('shelters/{id}', [App\Http\Controllers\Admin\ShelterController::class, 'update'])->name('shelters.update');
    Route::resource('managepet', ManagePetController::class);
    Route::resource('notifications', NotificationController::class);
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/statistics', [DashboardController::class, 'statistics'])->name('dashboard.statistics');
    Route::put('shelters/{id}', [AdoptionController::class, 'update'])->name('shelters.update');


});


// Application forms
Route::get('/adoption', [ApplicationController::class, 'showAdoptionForm'])->name('application.adoption-form');
Route::post('/adoption-submit', [ApplicationController::class, 'submitAdoption'])
    ->name('applications.adoption-submit');
Route::resource('adoptions', AdoptionController::class)->middleware('auth');


Route::get('/shelter', [ApplicationController::class, 'showShelterForm'])->name('application.shelter-form');
Route::post('/shelter', [ApplicationController::class, 'submitShelter'])->name('applications.submit-shelter');
Route::post('/shelter-submit', [ApplicationController::class, 'submitShelter'])->name('application.shelter-submit');

// Route for non-shelters to apply when blocked from adding a pet
Route::get('/apply-for-shelter', function () {
    return view('pets.apply-shelter');
})->middleware('auth')->name('apply.shelter');

// Shelter-specific routes (role check moved to controller)
Route::get('/pets/create', [App\Http\Controllers\Admin\PetController::class, 'create'])->name('pets.create')->middleware('auth');
Route::post('/pets', [App\Http\Controllers\Admin\PetController::class, 'store'])->name('pets.store')->middleware('auth');

// Adopt page routes
Route::get('/adopt', [PetController::class, 'index'])->name('adopt.index');
Route::get('/adopt/{pet}', [PetController::class, 'show'])->name('adopt.show');

// Authentication routes
Auth::routes();

// After login redirect
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('auth');


// Google Login
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('login/otp', [OtpController::class, 'showLoginForm'])->name('login.otp.form');
Route::post('login/otp/send', [OtpController::class, 'sendOtp'])->name('login.otp.send');
Route::post('login/otp/verify', [OtpController::class, 'verifyOtp'])->name('login.otp.verify');
