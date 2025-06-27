<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

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
        $bookings = Booking::all();
        return view('admin.bookings', compact('bookings'));
    }
    public function rooms()
    {
        return view('admin.ManageRooms');
    }
    public function guests()
    {
        $guests = User::where('usertype', 'user')->get();
        return view('admin.ManageGuests', compact('guests'));
    } 
    public function staffs()
    {
        return view('admin.ManageStaffs');
    }
    public function services()
    {
        return view('admin.services');
    }
    public function userbookings()
    {
        return view('bookings.index');
    }
}
