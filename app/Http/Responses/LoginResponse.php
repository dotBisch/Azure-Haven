<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();
        if ($user && $user->usertype === 'admin') {
            return redirect('/dashboard');
        }
        if ($user && $user->usertype === 'receptionist') {
            return redirect('/bookings');
        }
        return redirect('/home');
    }
} 