<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CarsController;
use App\Http\Controllers\Admin\StaysController;
use App\Http\Controllers\Admin\FeedbackController;
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
Route::get('/showstays', [DashboardController::class, 'stays'])->name('showstays');
Route::get('/showcars', [DashboardController::class, 'cars'])->name('showcars');



Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::post('/create', [UsersController::class,'store'])->name('store');
        Route::get('/edit/{id?}', [UsersController::class, 'edit'])->name('edit');
        Route::put('/update/{id?}', [UsersController::class, 'update'])->name('update');
        Route::post('/active/{id?}', [UsersController::class, 'toggleactive'])->name('toggleactive');
    });

});

Route::middleware(['auth', 'role:admin|manager'])->group(function () {


    Route::prefix('cars')->name('cars.')->group(function () {
        Route::get('/', [CarsController::class, 'index'])->name('index');
        Route::post('/create', [CarsController::class,'store'])->name('store');
        Route::get('/edit/{id?}', [CarsController::class, 'edit'])->name('edit');
        Route::put('/update/{id?}', [CarsController::class, 'update'])->name('update');
        Route::delete('/destroy/{id?}', [CarsController::class, 'destroy'])->name('destroy');
    });


});

Route::middleware(['auth', 'role:admin|manager'])->group(function () {

    Route::prefix('stays')->name('stays.')->group(function () {
        Route::get('/', [StaysController::class, 'index'])->name('index');
        Route::post('/create', [StaysController::class,'store'])->name('store');
        Route::get('/edit/{id?}', [StaysController::class, 'edit'])->name('edit');
        Route::put('/update/{id?}', [StaysController::class, 'update'])->name('update');
        Route::delete('/destroy/{id?}', [StaysController::class, 'destroy'])->name('destroy');
    });

});

Route::middleware(['auth', 'role:admin|manager'])->group(function () {

    Route::prefix('feedback')->name('feedback.')->group(function () {
        Route::get('/', [FeedbackController::class, 'index'])->name('index');
        Route::delete('/destroy/{id}', [FeedbackController::class, 'destroy'])->name('destroy');
    });

});



require __DIR__ . '/auth.php';
