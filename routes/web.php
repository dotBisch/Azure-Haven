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

route::get('/userbookings', [
    AdminController::class, 'userbookings'
])->name('userbookings');

route::get('/availability', [
    AdminController::class, 'userbookings'
])->name('availability');

route::get('/bookingHistory', [
    AdminController::class, 'bookingHistory'
])->name('bookingHistory');

route::get('/add-booking', [
    AdminController::class, 'addBooking'
])->name('add-booking');

route::post('/store-booking', [
    AdminController::class, 'storeBooking'
])->name('store-booking');

route::get('/add-room', [
    AdminController::class, 'addRoom'
])->name('add-room');

route::post('/store-room', [
    AdminController::class, 'storeRoom'
])->name('store-room');

route::get('/add-staff', [
    AdminController::class, 'addStaff'
])->name('add-staff');

route::post('/store-staff', [
    AdminController::class, 'storeStaff'
])->name('store-staff');

route::get('/add-service', [
    AdminController::class, 'addService'
])->name('add-service');

route::post('/store-service', [
    AdminController::class, 'storeService'
])->name('store-service');

route::get('/view-booking/{id}', [
    AdminController::class, 'viewBooking'
])->name('view-booking');

route::get('/view-room/{id}', [
    AdminController::class, 'viewRoom'
])->name('view-room');

route::get('/view-staff/{id}', [
    AdminController::class, 'viewStaff'
])->name('view-staff');

route::get('/view-service/{id}', [
    AdminController::class, 'viewService'
])->name('view-service');

route::get('/edit-booking/{id}', [
    AdminController::class, 'editBooking'
])->name('edit-booking');

route::put('/update-booking/{id}', [
    AdminController::class, 'updateBooking'
])->name('update-booking');

route::get('/edit-room/{id}', [AdminController::class, 'editRoom'])->name('edit-room');
route::put('/update-room/{id}', [AdminController::class, 'updateRoom'])->name('update-room');
route::get('/edit-staff/{id}', [AdminController::class, 'editStaff'])->name('edit-staff');
route::put('/update-staff/{id}', [AdminController::class, 'updateStaff'])->name('update-staff');
route::get('/edit-guest/{id}', [AdminController::class, 'editGuest'])->name('edit-guest');
route::put('/update-guest/{id}', [AdminController::class, 'updateGuest'])->name('update-guest');
route::get('/edit-service/{id}', [AdminController::class, 'editService'])->name('edit-service');
route::put('/update-service/{id}', [AdminController::class, 'updateService'])->name('update-service');

route::delete('/delete-booking/{id}', [AdminController::class, 'deleteBooking'])->name('delete-booking');
route::delete('/delete-room/{id}', [AdminController::class, 'deleteRoom'])->name('delete-room');
route::delete('/delete-staff/{id}', [AdminController::class, 'deleteStaff'])->name('delete-staff');
route::delete('/delete-guest/{id}', [AdminController::class, 'deleteGuest'])->name('delete-guest');
route::delete('/delete-service/{id}', [AdminController::class, 'deleteService'])->name('delete-service');

// Serve the room details page for Rooms & Services
Route::get('/roomsAndServices/room-details', function () {
    return view('roomsAndServices.room-details');
});

Route::get('/payment', function (\Illuminate\Http\Request $request) {
    if (auth()->check()) {
        $roomId = $request->query('room_id');
        $checkIn = $request->query('check_in_date');
        $checkOut = $request->query('check_out_date');
        if ($roomId && $checkIn && $checkOut) {
            $pendingBooking = \App\Models\Booking::where('user_id', auth()->id())
                ->where('booking_status', 'pending')
                ->where('room_id', $roomId)
                ->where('check_in_date', $checkIn)
                ->where('check_out_date', $checkOut)
                ->first();
            if ($pendingBooking) {
                return redirect()->route('home');
            }
        }
    }
    return view('home.payment');
})->middleware('auth')->name('payment');

Route::get('/confirm', function () {
    $booking = null;
    if (auth()->check()) {
        $booking = \App\Models\Booking::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->first();
    }
    return view('home.confirm', compact('booking'));
})->name('confirm');

Route::post('/checkout', [App\Http\Controllers\AdminController::class, 'userCheckout'])->name('user.checkout');

Route::get('/success', function () {
    return view('home.success');
})->name('success');

// route::get('/home', [
//      AdminController::class, 'home'
// ])->name('home');