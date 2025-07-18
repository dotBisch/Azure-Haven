<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $fillable = [
        'service_name',
        'service_price',
        'service_description',
        'service_pax',
    ];

    public function bookings()
    {
        return $this->belongsToMany(\App\Models\Booking::class, 'booking_service');
    }
} 