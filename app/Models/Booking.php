<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $primaryKey = 'booking_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'room_id',
        'user_id',
        'booking_status',
        'total_amount',
        'check_in_date',
        'check_out_date',
    ];

    public function services()
    {
        return $this->belongsToMany(\App\Models\Service::class, 'booking_service', 'booking_id', 'service_id');
    }

    public function room()
    {
        return $this->belongsTo(\App\Models\Room::class, 'room_id');
    }

    public function guest()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
