<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Reservations routes
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index')->middleware('admin');
Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
Route::post('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');

// Equipment routes
Route::get('/equipments', [EquipmentController::class, 'index'])->name('equipments.index')->middleware('admin');
Route::get('/equipments/create', [EquipmentController::class, 'create'])->name('equipments.create')->middleware('admin');
Route::post('/equipments', [EquipmentController::class, 'store'])->name('equipments.store')->middleware('admin');
Route::get('/equipments/{equipment}', [EquipmentController::class, 'show'])->name('equipments.show')->middleware('admin');
Route::get('/equipments/{equipment}/edit', [EquipmentController::class, 'edit'])->name('equipments.edit')->middleware('admin');
Route::put('/equipments/{equipment}', [EquipmentController::class, 'update'])->name('equipments.update')->middleware('admin');
Route::delete('/equipments/{equipment}', [EquipmentController::class, 'destroy'])->name('equipments.destroy')->middleware('admin');

// Room routes
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index')->middleware('admin');
Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create')->middleware('admin');
Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store')->middleware('admin');
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show')->middleware('admin');
Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit')->middleware('admin');
Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update')->middleware('admin');
Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy')->middleware('admin');

// User routes
Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('admin');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('admin');
Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware('admin');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show')->middleware('admin');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('admin');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('admin');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('admin');

// Role routes
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index')->middleware('admin');
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('admin');
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store')->middleware('admin');
Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show')->middleware('admin');
Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('admin');
Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update')->middleware('admin');
Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('admin');

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('admin');

// User-specific reservations
Route::get('/user-reservations', [ReservationController::class, 'userReservations'])->name('reservations.user');
