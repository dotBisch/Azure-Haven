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

    public function services()
    {
        return $this->belongsToMany(\App\Models\Service::class, 'booking_service', 'booking_id', 'service_id');
    }
}
