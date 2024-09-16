<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CancellationController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomEquipmentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;



Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::resource('equipment', EquipmentController::class);



Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
 


// Reservations routes
Route::resource('reservations', ReservationController::class);

// Cancellations routes
Route::resource('cancellations', CancellationController::class);

// Rooms routes
Route::resource('rooms', RoomController::class);

// Equipment routes

// Room Equipment routes
Route::resource('room_equipment', RoomEquipmentController::class);

// Users routes
Route::resource('users', UserController::class);

// Roles routes
Route::resource('roles', RoleController::class);



Route::get('/test-email', function () {
    Mail::raw('This is a test email from Sendinblue using Laravel SMTP.', function ($message) {
        $message->to('mohamedhaki70@gmail.com')
                ->subject('Test Email');
    });

    return 'Test email has been sent!';
});
