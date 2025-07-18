<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Service;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            
            $usertype = Auth()->user()->usertype;

            if ($usertype == 'user') {
                return view('home.index');
            }
            else if (in_array($usertype, ['admin', 'receptionist'])) {
                return view('admin.index');
            } else {
                return redirect()->back();
            }
        } 
    }

    public function home()
    {
        return view('home.index');
    }
    public function homeIndex()
    {
        return view('home.index');
    }
    public function aboutIndex()
    {
        return view('aboutUs.index');
    }
    public function roomsAndServicesIndex()
    {
        return view('roomsAndServices.index');
    }
        public function contactUsIndex()
    {
        return view('contactUs.index');
    }
    public function dashboard()
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized');
        }
        $totalBookings = Booking::count();
        $checkInCount = Booking::where('booking_status', 'checked_in')->count();
        $checkOutCount = Booking::where('booking_status', 'checked_out')->count();

        $totalRevenue = Booking::sum('total_amount');
        $revenue30 = Booking::where('created_at', '>=', Carbon::now()->subDays(30))->sum('total_amount');
        $revenue7 = Booking::where('created_at', '>=', Carbon::now()->subDays(7))->sum('total_amount');

        $recentArrivals = Booking::with(['guest', 'room'])
            ->where('booking_status', 'checked_in')
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        $notifications = Booking::with('room')
            ->orderBy('updated_at', 'desc')
            ->take(3)
            ->get();

        $receptionists = User::where('usertype', 'receptionist')->get();

        $totalRooms = Room::count();
        $availableRooms = Room::where('room_status', 'available')->count();
        $occupiedRooms = Room::where('room_status', 'occupied')->count();
        $maintenanceRooms = Room::where('room_status', 'maintenance')->count();

        $totalServices = Service::count();
        $topService = Service::orderBy('service_price', 'desc')->first();

        return view('admin.index', compact(
            'totalBookings', 'checkInCount', 'checkOutCount',
            'totalRevenue', 'revenue30', 'revenue7',
            'recentArrivals', 'notifications', 'receptionists',
            'totalRooms', 'availableRooms', 'occupiedRooms', 'maintenanceRooms',
            'totalServices', 'topService'
        ));
    }
    public function bookings()
    {
        if (!in_array(auth()->user()->usertype, ['admin', 'receptionist'])) {
            abort(403, 'Unauthorized');
        }
        $bookings = Booking::with(['services', 'room', 'guest'])->paginate(4);
        return view('admin.bookings', compact('bookings'));
    }
    public function rooms()
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized');
        }
        $rooms = Room::paginate(4);
        return view('admin.ManageRooms', compact('rooms'));
    }
    public function guests()
    {
        if (!in_array(auth()->user()->usertype, ['admin', 'receptionist'])) {
            abort(403, 'Unauthorized');
        }
        $guests = User::where('usertype', 'user')->paginate(7);
        return view('admin.ManageGuests', compact('guests'));
    } 
    public function staffs()
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized');
        }
        $staffs = User::whereIn('usertype', ['admin', 'receptionist'])->paginate(4);
        return view('admin.ManageStaffs', compact('staffs'));
    }
    public function services()
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized');
        }
        $services = Service::paginate(5);
        return view('admin.services', compact('services'));
    }
    public function userbookings(Request $request)
    {
        // Get form data from the request
        $checkin = $request->get('checkin');
        $checkout = $request->get('checkout');
        $guests = $request->get('guests');
        $numberOfRooms = $request->get('rooms');

        // Get available rooms that match the criteria
        $availableRooms = Room::where('room_status', 'available')
            ->where('room_pax', '>=', $guests ?? 1)
            ->get();

        // If dates are provided, filter out rooms that are already booked for those dates
        if ($checkin && $checkout) {
            $bookedRoomIds = Booking::where(function($query) use ($checkin, $checkout) {
                $query->where(function($q) use ($checkin, $checkout) {
                    $q->where('check_in_date', '<=', $checkout)
                      ->where('check_out_date', '>=', $checkin);
                })
                ->whereIn('booking_status', ['confirmed', 'checked_in']);
            })->pluck('room_id');

            $availableRooms = $availableRooms->whereNotIn('id', $bookedRoomIds);
        }

        return view('home.availability', compact('availableRooms', 'checkin', 'checkout', 'guests', 'numberOfRooms'));
    }
    public function bookingHistory()
    {
        $bookings = Booking::with(['services', 'room'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('bookings.index', compact('bookings'));
    }

    public function addBooking()
    {
        $rooms = Room::where('room_status', 'available')->get();
        $services = Service::all();
        $users = User::where('usertype', 'user')->get();
        
        return view('admin.add-booking', compact('rooms', 'services', 'users'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'user_id' => 'required|exists:users,id',
            'booking_status' => 'required|in:pending,confirmed,checked_in,checked_out,cancelled',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'services' => 'array',
            'services.*' => 'exists:services,id'
        ]);

        // Calculate total amount
        $room = Room::find($request->room_id);
        
        // Calculate number of nights
        $checkIn = new \DateTime($request->check_in_date);
        $checkOut = new \DateTime($request->check_out_date);
        $numberOfNights = $checkIn->diff($checkOut)->days;
        
        // Calculate room total (price per night * number of nights)
        $roomTotal = $room->room_price * $numberOfNights;
        $totalAmount = $roomTotal;
        
        // Add services total
        if ($request->has('services')) {
            $selectedServices = Service::whereIn('id', $request->services)->get();
            foreach ($selectedServices as $service) {
                $totalAmount += $service->service_price;
            }
        }

        // Create booking
        $booking = Booking::create([
            'room_id' => $request->room_id,
            'user_id' => $request->user_id,
            'booking_status' => $request->booking_status,
            'total_amount' => $totalAmount,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
        ]);

        // Attach services if any
        if ($request->has('services')) {
            $booking->services()->attach($request->services);
        }

        // Update room status to occupied
        $room->update(['room_status' => 'occupied']);

        return redirect()->route('bookings')->with('success', 'Booking created successfully!');
    }

    public function addRoom()
    {
        return view('admin.add-room');
    }

    public function storeRoom(Request $request)
    {
        $request->validate([
            'room_number' => 'required|string|unique:rooms,room_number',
            'room_type' => 'required|string',
            'room_price' => 'required|numeric|min:0',
            'room_description' => 'required|string',
            'room_pax' => 'required|integer|min:1',
            'room_features' => 'nullable|string',
            'room_inclusions' => 'nullable|string',
            'room_image' => 'nullable|string',
        ]);

        Room::create([
            'room_number' => $request->room_number,
            'room_type' => $request->room_type,
            'room_price' => $request->room_price,
            'room_description' => $request->room_description,
            'room_pax' => $request->room_pax,
            'room_features' => $request->room_features,
            'room_inclusions' => $request->room_inclusions,
            'room_image' => $request->room_image ?: 'default-room.jpg',
            'room_status' => 'available',
        ]);

        return redirect()->route('rooms')->with('success', 'Room added successfully!');
    }

    public function addStaff()
    {
        return view('admin.add-staff');
    }

    public function storeStaff(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'usertype' => 'required|in:user,admin,receptionist',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'usertype' => $request->usertype,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('staffs')->with('success', 'User added successfully!');
    }

    public function addService()
    {
        return view('admin.add-service');
    }

    public function storeService(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'service_price' => 'required|numeric|min:0',
            'service_description' => 'required|string',
            'service_pax' => 'required|integer|min:1',
        ]);

        Service::create([
            'service_name' => $request->service_name,
            'service_price' => $request->service_price,
            'service_description' => $request->service_description,
            'service_pax' => $request->service_pax,
        ]);

        return redirect()->route('services')->with('success', 'Service added successfully!');
    }

    public function viewBooking($id)
    {
        $booking = Booking::with(['services', 'room', 'guest'])->findOrFail($id);
        return view('admin.view-booking', compact('booking'));
    }

    public function viewRoom($id)
    {
        $room = Room::findOrFail($id);
        return view('admin.view-room', compact('room'));
    }

    public function viewStaff($id)
    {
        $staff = User::findOrFail($id);
        return view('admin.view-staff', compact('staff'));
    }

    public function viewService($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.view-service', compact('service'));
    }

    public function editBooking($id)
    {
        $booking = Booking::with(['services', 'room', 'guest'])->findOrFail($id);
        $rooms = Room::where('room_status', 'available')->orWhere('id', $booking->room_id)->get();
        $services = Service::all();
        $users = User::where('usertype', 'user')->get();
        return view('admin.edit-booking', compact('booking', 'rooms', 'services', 'users'));
    }

    public function updateBooking(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'user_id' => 'required|exists:users,id',
            'booking_status' => 'required|in:pending,confirmed,checked_in,checked_out,cancelled',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'services' => 'array',
            'services.*' => 'exists:services,id'
        ]);

        $room = Room::find($request->room_id);
        $checkIn = new \DateTime($request->check_in_date);
        $checkOut = new \DateTime($request->check_out_date);
        $numberOfNights = $checkIn->diff($checkOut)->days;
        $roomTotal = $room->room_price * $numberOfNights;
        $totalAmount = $roomTotal;
        if ($request->has('services')) {
            $selectedServices = Service::whereIn('id', $request->services)->get();
            foreach ($selectedServices as $service) {
                $totalAmount += $service->service_price;
            }
        }

        $booking->update([
            'room_id' => $request->room_id,
            'user_id' => $request->user_id,
            'booking_status' => $request->booking_status,
            'total_amount' => $totalAmount,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
        ]);
        $booking->services()->sync($request->services ?? []);
        $room->update(['room_status' => 'occupied']);
        return redirect()->route('bookings')->with('success', 'Booking updated successfully!');
    }

    public function editRoom($id)
    {
        $room = Room::findOrFail($id);
        return view('admin.edit-room', compact('room'));
    }

    public function updateRoom(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        $request->validate([
            'room_number' => 'required|string|unique:rooms,room_number,' . $id,
            'room_type' => 'required|string',
            'room_price' => 'required|numeric|min:0',
            'room_description' => 'required|string',
            'room_pax' => 'required|integer|min:1',
            'room_features' => 'nullable|string',
            'room_inclusions' => 'nullable|string',
            'room_image' => 'nullable|string',
            'room_status' => 'required|in:available,occupied,maintenance'
        ]);
        $room->update($request->all());
        return redirect()->route('rooms')->with('success', 'Room updated successfully!');
    }

    public function editStaff($id)
    {
        $staff = User::findOrFail($id);
        return view('admin.edit-staff', compact('staff'));
    }

    public function updateStaff(Request $request, $id)
    {
        $staff = User::findOrFail($id);
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'usertype' => 'required|in:admin,receptionist',
        ]);
        $staff->update($request->all());
        return redirect()->route('staffs')->with('success', 'Staff updated successfully!');
    }

    public function editGuest($id)
    {
        $guest = User::findOrFail($id);
        return view('admin.edit-guest', compact('guest'));
    }

    public function updateGuest(Request $request, $id)
    {
        $guest = User::findOrFail($id);
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'usertype' => 'required|in:user',
        ]);
        $guest->update($request->all());
        return redirect()->route('guests')->with('success', 'Guest updated successfully!');
    }

    public function editService($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.edit-service', compact('service'));
    }

    public function updateService(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $request->validate([
            'service_name' => 'required|string|max:255',
            'service_price' => 'required|numeric|min:0',
            'service_description' => 'required|string',
            'service_pax' => 'required|integer|min:1',
        ]);
        $service->update($request->all());
        return redirect()->route('services')->with('success', 'Service updated successfully!');
    }

    public function deleteBooking($id) {
        $booking = Booking::findOrFail($id);
        // Set the room status to available
        if ($booking->room_id) {
            $room = Room::find($booking->room_id);
            if ($room) {
                $room->room_status = 'available';
                $room->save();
            }
        }
        $booking->delete();
        return redirect()->route('bookings')->with('success', 'Booking deleted successfully and room set to available!');
    }
    public function deleteRoom($id) {
        Room::findOrFail($id)->delete();
        return redirect()->route('rooms')->with('success', 'Room deleted successfully!');
    }
    public function deleteStaff($id) {
        User::where('usertype', 'admin')->findOrFail($id)->delete();
        return redirect()->route('staffs')->with('success', 'Staff deleted successfully!');
    }
    public function deleteGuest($id) {
        User::where('usertype', 'user')->findOrFail($id)->delete();
        return redirect()->route('guests')->with('success', 'Guest deleted successfully!');
    }
    public function deleteService($id) {
        Service::findOrFail($id)->delete();
        return redirect()->route('services')->with('success', 'Service deleted successfully!');
    }

    public function userCheckout(Request $request)
    {
        // Validate input (adjust as needed for your form fields)
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'guests' => 'required|integer|min:1',
            'rooms' => 'required|integer|min:1|max:3',
            // Add more validation as needed
        ]);

        // Find the room
        $room = Room::find($request->room_id);
        if (!$room) {
            return back()->withErrors(['room_id' => 'Selected room not found.']);
        }

        // Calculate number of nights
        $checkIn = new \DateTime($request->check_in_date);
        $checkOut = new \DateTime($request->check_out_date);
        $numberOfNights = $checkIn->diff($checkOut)->days;
        $roomTotal = $room->room_price * $numberOfNights * $request->rooms;
        $totalAmount = $roomTotal; // Add services if needed

        // Create booking with status 'pending'
        $booking = Booking::create([
            'room_id' => $room->id,
            'user_id' => auth()->id(),
            'booking_status' => 'pending',
            'total_amount' => $totalAmount,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
        ]);

        // Attach services if any
        if ($request->has('services')) {
            $booking->services()->attach($request->services);
        }

        // Set room status to occupied
        $room->update(['room_status' => 'occupied']);

        // Redirect to confirm page (optionally pass booking id)
        return redirect()->route('confirm')->with('success', 'Booking submitted!');
    }
}
