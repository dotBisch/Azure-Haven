<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::get('/', [AdminController::class, 'home']);

route::get('/home', [
    AdminController::class, 'homeIndex'
])->name('home');

route::get('/aboutUs', [
    AdminController::class, 'aboutIndex'
])->name('aboutUs');

route::get('/roomsAndServices', [
    AdminController::class, 'roomsAndServicesIndex'
])->name('roomsAndServices');

route::get('/contactUs', [
    AdminController::class, 'contactUsIndex'
])->name('contactUs');

//for AdminController
route::get('/dashboard', [
    AdminController::class, 'dashboard'
])->name('dashboard');

route::get('/bookings', [
    AdminController::class, 'bookings'
])->name('bookings');

route::get('/rooms', [
    AdminController::class, 'rooms'
])->name('rooms');

route::get('/guests', [
    AdminController::class, 'guests'
])->name('guests');

route::get('/staffs', [
    AdminController::class, 'staffs'
])->name('staffs');

route::get('/services', [
    AdminController::class, 'services'
])->name('services');

// route::get('/home', [
//      AdminController::class, 'home'
// ])->name('home');