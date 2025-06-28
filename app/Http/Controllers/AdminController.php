<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Service;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            
            $usertype = Auth()->user()->usertype;

            if ($usertype == 'user') {
                return view('home.index');
            }
            else if ($usertype == 'admin')
            {
                return view('admin.index');
            }
            else 
            {
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
        if (Auth::check() && Auth::user()->usertype === 'admin') {
            return view('admin.index');
        }
        return redirect('/home');
    }
    public function bookings()
    {
        $bookings = Booking::with(['services', 'room', 'guest'])->paginate(3);
        return view('admin.bookings', compact('bookings'));
    }
    public function rooms()
    {
        $rooms = Room::paginate(4);
        return view('admin.ManageRooms', compact('rooms'));
    }
    public function guests()
    {
        $guests = User::where('usertype', 'user')->paginate(7);
        return view('admin.ManageGuests', compact('guests'));
    } 
    public function staffs()
    {
        $staffs = User::where('usertype', 'admin')->paginate(4);
        return view('admin.ManageStaffs', compact('staffs'));
    }
    public function services()
    {
        $services = Service::paginate(5);
        return view('admin.services', compact('services'));
    }
    public function userbookings()
    {
        return view('bookings.index');
    }
    public function bookingHistory()
    {
        return view('bookings.index');
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
            'check_in_date' => 'required|date|after:today',
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
            'booking_status' => 'pending',
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
            'usertype' => 'required|in:user,admin',
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
}
