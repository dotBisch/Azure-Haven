<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('services')->insert([
            [
                'service_name' => 'Regular Car – Pick-up',
                'service_price' => 1200,
                'service_description' => 'Comfortable sedan for airport or terminal transfer. Fully air-conditioned and driver-assisted.',
                'service_pax' => 3,
            ],
            [
                'service_name' => 'Regular Car – Drop-off',
                'service_price' => 1200,
                'service_description' => 'Comfortable sedan for airport or terminal transfer. Fully air-conditioned and driver-assisted.',
                'service_pax' => 3,
            ],
            [
                'service_name' => 'Van – Pick-up',
                'service_price' => 2000,
                'service_description' => 'Spacious van ideal for groups or families. Includes luggage space, air-conditioning, and professional driver.',
                'service_pax' => 10,
            ],
            [
                'service_name' => 'Van – Drop-off',
                'service_price' => 2000,
                'service_description' => 'Spacious van ideal for groups or families. Includes luggage space, air-conditioning, and professional driver.',
                'service_pax' => 10,
            ],
            [
                'service_name' => 'Relaxation Massage',
                'service_price' => 800,
                'service_description' => 'A gentle full-body massage using light to medium pressure to relieve stress and promote calm. (60 mins)',
                'service_pax' => 1,
            ],
            [
                'service_name' => 'Therapeutic Deep Tissue Massage',
                'service_price' => 1200,
                'service_description' => 'Focused deep pressure massage to release chronic tension in muscles and joints. (60 mins)',
                'service_pax' => 1,
            ],
            [
                'service_name' => 'Couples Massage',
                'service_price' => 2000,
                'service_description' => 'Enjoy a simultaneous side-by-side massage in a private room, perfect for partners or friends. (60 mins)',
                'service_pax' => 2,
            ],
        ]);
    }
} 