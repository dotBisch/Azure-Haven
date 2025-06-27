<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('bookings')->insert([
            [
                'room_id' => 1,
                'service_id' => null,
                'user_id' => 5,
                'booking_status' => 'confirmed',
                'total_amount' => 3200.00,
                'check_in_date' => '2024-07-01',
                'check_out_date' => '2024-07-03',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_id' => 2,
                'service_id' => null,
                'user_id' => 5,
                'booking_status' => 'pending',
                'total_amount' => 3500.00,
                'check_in_date' => '2024-07-10',
                'check_out_date' => '2024-07-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 