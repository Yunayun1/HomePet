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
use App\Models\User;
use App\Http\Controllers\Admin\ManagePetController;

// Public Pages
// Public Pages (require auth)
Route::view('/', 'index')->middleware('auth');
Route::view('/about', 'about')->middleware('auth');
Route::view('/blog', 'blog')->middleware('auth');
Route::view('/adopt', 'adopt')->middleware('auth');
Route::view('/search', 'search')->middleware('auth');
Route::view('/blog-single', 'blog-single')->middleware('auth');
Route::view('/contact', 'contact')->middleware('auth');
Route::view('/gallery', 'gallery')->middleware('auth');
Route::view('/main', 'main')->middleware('auth');
Route::view('/pricing', 'pricing')->middleware('auth');
Route::view('/services', 'services')->middleware('auth');
Route::view('/vet', 'vet')->middleware('auth');

//Admin routes group
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::match(['post', 'put'], 'users/{user}/ban', [UserController::class, 'ban'])->name('users.ban');
    Route::post('users/{user}/unban', [UserController::class, 'unban'])->name('users.unban');
    Route::resource('adoptions', AdoptionController::class);
    Route::resource('managepet', ManagePetController::class);
    Route::resource('notifications', NotificationController::class);
});

// Route::resource('/admin/managepet', ManagePetController::class)
//     ->middleware('auth'); 

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