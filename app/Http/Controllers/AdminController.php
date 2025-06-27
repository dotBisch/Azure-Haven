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
        $bookings = Booking::with('services')->paginate(7);
        return view('admin.bookings', compact('bookings'));
    }
    public function rooms()
    {
        $rooms = Room::paginate(5);
        return view('admin.ManageRooms', compact('rooms'));
    }
    public function guests()
    {
        $guests = User::where('usertype', 'user')->get();
        return view('admin.ManageGuests', compact('guests'));
    } 
    public function staffs()
    {
        $staffs = User::where('usertype', 'admin')->get();
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
}
