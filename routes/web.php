<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Auth\AuthController;


use App\Http\Controllers\Admin1\CustomerController1;
use App\Http\Controllers\Admin1\OrderController1 as AdminOrderController1;
use App\Http\Controllers\Admin1\RoomController1;
use App\Http\Controllers\Admin1\RoomTypeController1;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Pages
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/events', [PageController::class, 'list_rooms'])->name('rooms.index');
Route::post('/events', [PageController::class, 'search'])->name('search');

// Profile (for logged-in users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [PageController::class, 'showProfile'])->name('profile');
    Route::put('/profile', [PageController::class, 'updateProfile']);

    // User Orders
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/{order}/leave-waiting', [OrderController::class, 'leaveWaiting'])
        ->name('orders.leaveWaiting');
});

/************************************
 *              Auth
 ************************************/
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'showRegistrationForm')->name('register');
    Route::post('register', 'register');

    Route::get('login', 'showLoginForm')->name('login');
    Route::post('login', 'login');

    Route::post('logout', 'logout')->name('logout');
});

/************************************
 *              Admin (Panel A)
 ************************************/
Route::prefix('organizer')->name('organizer.')->middleware(['auth', 'admin.access:organizer'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // Orders (Admin side)
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');
    Route::get('orders/waiting', [AdminOrderController::class, 'waitingOrders'])->name('orders.waiting');

    // Room Types + Rooms
    Route::resource('eventtypes', RoomTypeController::class)->except('show');
    Route::resource('events', AdminRoomController::class)->except('show');

    // Customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
});

/************************************
 *              Admin1 (Panel B)
 ************************************/
Route::prefix('organizer1')->name('organizer1.')->middleware(['auth', 'admin.access:organizer1'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('index');
   Route::get('/orders', [AdminOrderController1::class, 'index'])->name('orders.index');
    Route::put('/orders/{order}', [AdminOrderController1::class, 'update'])->name('orders.update');
    Route::get('orders/waiting', [AdminOrderController1::class, 'waitingOrders'])->name('orders.waiting');

    // Room Types + Rooms
    Route::resource('eventtypes', RoomTypeController1::class)->except('show');
   Route::resource('events', RoomController1::class)->except('show');

    // Customers
    Route::get('/customers', [CustomerController1::class, 'index'])->name('customers.index');
});