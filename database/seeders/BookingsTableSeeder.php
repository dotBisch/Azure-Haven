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
                'booking_id' => 1,
                'room_id' => 1,
                'user_id' => 5,
                'booking_status' => 'confirmed',
                'total_amount' => 3200.00,
                'check_in_date' => '2024-07-01',
                'check_out_date' => '2024-07-03',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 2,
                'room_id' => 2,
                'user_id' => 5,
                'booking_status' => 'pending',
                'total_amount' => 3500.00,
                'check_in_date' => '2024-07-10',
                'check_out_date' => '2024-07-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed the booking_service pivot table
        DB::table('booking_service')->insert([
            [
                'booking_id' => 1,
                'service_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 1,
                'service_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 2,
                'service_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 