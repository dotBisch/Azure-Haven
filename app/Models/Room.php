<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $fillable = [
        'room_number',
        'room_type',
        'room_price',
        'room_description',
        'room_pax',
        'room_features',
        'room_inclusions',
        'room_status',
        'room_image',
    ];
} 