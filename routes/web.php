<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\GoogleController; // Only this one!
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ShelterController;
use App\Http\Controllers\Admin\AdoptionController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Admin\ManagePetController;
use App\Models\User;


// Public Pages
// Public Pages (require auth)
Route::view('/', 'index')->name('welcome');
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
    Route::resource('managepet', ManagePetController::class);
    Route::resource('notifications', NotificationController::class);
});

Route::get('/admin', function () {
    $activeUsersCount = User::where('is_banned', false)
                            ->where('role', '!=', 'admin')
                            ->count();
    return view('admin.dashboard.index', compact('activeUsersCount'));
})->middleware(['auth'])->name('admin.dashboard');

// Application forms
Route::get('/apply/adoption', [ApplicationController::class, 'showAdoptionForm'])->name('applications.adoption.form');
Route::post('/apply/adoption', [ApplicationController::class, 'submitAdoption'])->name('applications.adoption.submit');

Route::get('/apply/shelter', [ApplicationController::class, 'showShelterForm'])->name('applications.shelter.form');
Route::post('/apply/shelter', [ApplicationController::class, 'submitShelter'])->name('applications.shelter.submit');

// Route for non-shelters to apply when blocked from adding a pet
Route::get('/apply-for-shelter', function () {
    return view('pets.apply-shelter');
})->middleware('auth')->name('apply.shelter');

// // Form to add pet
// Route::get('/pets/create', [PetController::class, 'create'])->name('pets.create')->middleware('auth');
// Route::post('/pets', [PetController::class, 'store'])->name('pets.store')->middleware('auth');
// Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
// Route::get('/pets/{pet}', [PetController::class, 'show'])->name('pets.show');


// Route::get('/adopt', [PetController::class, 'index'])->name('adopt.index');
// Route::get('/adopt/{id}', [PetController::class, 'show'])->name('adopt.show');

Route::get('/adopt', [PetController::class, 'index'])->name('adopt.index');
Route::get('/adopt/{id}', [PetController::class, 'show'])->name('adopt.show');

Route::get('/pets', [App\Http\Controllers\Admin\PetController::class, 'index'])->name('pets.index');
Route::get('/pets/create', [PetController::class, 'create'])->name('pets.create');
Route::post('/pets', [PetController::class, 'store'])->name('pets.store');
// Authentication routes
Auth::routes();

// After login redirect
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('auth');


Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);