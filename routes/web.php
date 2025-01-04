<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/contactus', [DashboardController::class, 'contactus'])->name('contactus');
Route::get('/aboutus', [DashboardController::class, 'aboutus'])->name('aboutus');
Route::get('/', [DashboardController::class, 'welcome'])->name('welcome');
Route::get('/Services', [DashboardController::class, 'Services'])->name('Services');
Route::get('/stays', [DashboardController::class, 'stays'])->name('stays');
Route::get('/cars', [DashboardController::class, 'cars'])->name('cars');



Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('index');
    });
});

require __DIR__ . '/auth.php';
