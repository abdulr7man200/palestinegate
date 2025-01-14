<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CarsController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\StaysController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ContactController as userContactController;






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/booking/{id}',  [DashboardController::class, 'bookingbyid'])->name('bookingbyid');
    Route::post('/booknow',  [DashboardController::class, 'booknow'])->name('booknow');
    Route::post('/booknowstay',  [DashboardController::class, 'booknowstay'])->name('booknowstay');
    Route::post('/booknowroom',   [DashboardController::class, 'booknowroom'])->name('booknowroom');
    Route::post('/payment',  [DashboardController::class, 'payment'])->name('payment');
    Route::get('reservations',  [DashboardController::class, 'reservations'])->name('reservations');
    Route::post('addfeedback/{id?}',  [DashboardController::class, 'addfeedback'])->name('addfeedback');


});

Route::get('/contactus', action: [DashboardController::class, 'contactus'])->name('contactus');
Route::get('/aboutus', [DashboardController::class, 'aboutus'])->name('aboutus');
Route::get('/', [DashboardController::class, 'welcome'])->name('welcome');
Route::get('/services', [DashboardController::class, 'Services'])->name('Services');
Route::get('/showstays', [DashboardController::class, 'stays'])->name('showstays');
Route::get('/showcars', [DashboardController::class, 'cars'])->name('showcars');
Route::get('/showrooms/{id}', [DashboardController::class, 'rooms'])->name('showrooms');
Route::get('/car/{id}',  [DashboardController::class, 'cardetails'])->name('cardetails');
Route::get('/stay/{id}',  [DashboardController::class, 'staydetails'])->name('staydetails');
Route::get('/room/{id}',  [DashboardController::class, 'roomdetails'])->name('roomdetails');



Route::post('/add/contact', [userContactController::class, 'store'])->name('contactus.store');


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
        Route::post('/update/{id?}', [CarsController::class, 'update'])->name('update');
        Route::delete('/destroy/{id?}', [CarsController::class, 'destroy'])->name('destroy');
        Route::post('/isrecommended/{id?}', [CarsController::class, 'isrecommended'])->name('isrecommended');

    });



    Route::prefix('stays')->name('stays.')->group(function () {
        Route::get('/', [StaysController::class, 'index'])->name('index');
        Route::post('/create', [StaysController::class,'store'])->name('store');
        Route::get('/edit/{id?}', [StaysController::class, 'edit'])->name('edit');
        Route::post('/update/{id?}', [StaysController::class, 'update'])->name('update');
        Route::delete('/destroy/{id?}', [StaysController::class, 'destroy'])->name('destroy');
        Route::post('/isrecommended/{id?}', [StaysController::class, 'isrecommended'])->name('isrecommended');
    });

    Route::prefix('rooms')->name('rooms.')->group(function () {
        Route::get('/', [RoomController::class, 'index'])->name('index');
        Route::post('/create', [RoomController::class,'store'])->name('store');
        Route::get('/edit/{id?}', [RoomController::class, 'edit'])->name('edit');
        Route::post('/update/{id?}', [RoomController::class, 'update'])->name('update');
        Route::delete('/destroy/{id?}', [RoomController::class, 'destroy'])->name('destroy');
    });



    Route::prefix('feedback')->name('feedback.')->group(function () {
        Route::get('/', [FeedbackController::class, 'index'])->name('index');
        Route::delete('/destroy/{id}', [FeedbackController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('contact')->name('contact.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::get('/show/{id}', [ContactController::class, 'show'])->name('show');
        Route::delete('/destroy/{id}', [ContactController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('booking')->name('booking.')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('index');
        Route::get('/edit/{id?}', [BookingController::class, 'edit'])->name('edit');
        Route::post('/update/{id?}', [BookingController::class, 'update'])->name('update');
        Route::delete('/destroy/{id?}', [BookingController::class, 'destroy'])->name('destroy');
    });



});



require __DIR__ . '/auth.php';
