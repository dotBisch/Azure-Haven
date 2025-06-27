<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('rooms')->insert([
            [
                'room_number' => '1',
                'room_type' => 'Deluxe Queen Room',
                'room_price' => 3200,
                'room_description' => 'Elegant room with a queen-size bed, city view, private bath, and workspace. Ideal for solo travelers or couples.',
                'room_pax' => 2,
                'room_inclusions' => 'Complimentary Wi-Fi,Daily housekeeping,Coffee & tea making facilities,Air-conditioning,Toiletries & towels',
                'room_features' => '1 Bathroom,2 Wall outlets,1 Mini bar,1 TV,1 Armchair,1 Iron and ironing board,1 Phone,1 Hairdryer',
                'room_status' => 'available',
                'room_image' => 'placeholder.png',
            ],
            [
                'room_number' => '2',
                'room_type' => 'Superior Twin Room',
                'room_price' => 3500,
                'room_description' => 'Two cozy single beds with modern decor, smart TV, and free breakfast. Great for friends or work trips.',
                'room_pax' => 2,
                'room_inclusions' => 'Complimentary breakfast,Free high-speed Wi-Fi,Air-conditioning,In-room safe,Toiletries & slippers,Bottled water daily',
                'room_features' => '1 Bathroom,4 Wall outlets,1 TV,2 Armchairs,1 Iron and ironing board,1 Phone,1 Hairdryer',
                'room_status' => 'available',
                'room_image' => 'placeholder.png',
            ],
            [
                'room_number' => '3',
                'room_type' => 'Executive King Suite',
                'room_price' => 5800,
                'room_description' => 'Spacious suite with king-size bed, living area, large windows, mini bar, and premium toiletries.',
                'room_pax' => 2,
                'room_inclusions' => 'Complimentary minibar,Bathrobe & premium toiletries,Daily breakfast for two,Free Wi-Fi & smart TV,24-hour room service,Welcome drink upon arrival',
                'room_features' => '2 Bathrooms,8 Wall outlets,2 Mini bars,2 TVs,4 Armchairs,2 Iron and ironing boards,2 Phones,2 Hairdryers',
                'room_status' => 'available',
                'room_image' => 'placeholder.png',
            ],
            [
                'room_number' => '4',
                'room_type' => 'Family Room',
                'room_price' => 4700,
                'room_description' => 'One queen bed and two single beds, perfect for small families. Comes with Netflix-ready smart TV and fridge.',
                'room_pax' => 4,
                'room_inclusions' => 'Netflix-ready smart TV,Mini fridge,Complimentary bottled water,Board games upon request,Daily housekeeping,Wi-Fi access for multiple devices',
                'room_features' => '1 Bathroom,6 Wall outlets,1 TV,2 Armchairs,1 Iron and ironing board,1 Phone,1 Hairdryer',
                'room_status' => 'available',
                'room_image' => 'placeholder.png',
            ],
            [
                'room_number' => '5',
                'room_type' => 'Budget Single Room',
                'room_price' => 1500,
                'room_description' => 'Compact but clean and modern room with single bed, private shower, and desk. Great for short stays.',
                'room_pax' => 1,
                'room_inclusions' => 'Free Wi-Fi,Fresh towels & toiletries,Air-conditioning,Desk with reading lamp,Daily housekeeping,Complimentary bottled water',
                'room_features' => '1 Bathroom,2 Wall outlets,1 TV,1 Armchair,1 Phone,1 Hairdryer',
                'room_status' => 'available',
                'room_image' => 'placeholder.png',
            ],
            [
                'room_number' => '6',
                'room_type' => 'Junior Suite',
                'room_price' => 4200,
                'room_description' => 'Stylish room with queen bed, small living area, bath tub, and balcony view.',
                'room_pax' => 2,
                'room_inclusions' => 'Balcony with seating area,Complimentary bath salts,Coffee & tea maker,Free Wi-Fi & smart TV,Soft bathrobes & slippers,Daily breakfast for two',
                'room_features' => '1 Bathroom with bathtub,4 Wall outlets,1 Mini bar,1 TV,2 Armchairs,1 Iron and ironing board,1 Phone,1 Hairdryer',
                'room_status' => 'available',
                'room_image' => 'placeholder.png',
            ],
            [
                'room_number' => '7',
                'room_type' => 'Penthouse Suite',
                'room_price' => 12000,
                'room_description' => 'Top-floor luxury suite with panoramic seaside view, king bed, sofa lounge, jacuzzi, and dedicated concierge.',
                'room_pax' => 2,
                'room_inclusions' => 'Panoramic view lounge access,Private jacuzzi with bath amenities,Premium minibar & wine selection,Concierge service,Complimentary breakfast and dinner,Late check-out (subject to availability),Welcome fruit basket & champagne',
                'room_features' => '2 Bathrooms,10 Wall outlets,2 Mini bars,2 TVs,4 Armchairs,2 Iron and ironing boards,2 Phones,2 Hairdryers',
                'room_status' => 'available',
                'room_image' => 'placeholder.png',
            ],
            [
                'room_number' => '8',
                'room_type' => 'Barkada Room',
                'room_price' => 3000,
                'room_description' => 'Dorm-style room with 4 bunk beds, shared bath, lockers, and common lounge area.',
                'room_pax' => 8,
                'room_inclusions' => 'Individual lockers with key,Shared bathroom with hot & cold shower,Free Wi-Fi,Lounge area with board games & TV,Drinking water station,Towel rental available',
                'room_features' => '2 Shared,8 Wall outlets,1 TV,4 Armchairs,1 Iron and ironing board,1 Hairdryer',
                'room_status' => 'available',
                'room_image' => 'placeholder.png',
            ],
            [
                'room_number' => '9',
                'room_type' => 'Accessible Room',
                'room_price' => 2900,
                'room_description' => 'Queen-size bed with accessible layout, support rails in bathroom, wide doorway, and emergency alert system.',
                'room_pax' => 2,
                'room_inclusions' => 'Wheelchair-accessible layout,Emergency alert system,Bathroom support rails,Lowered bed height & furniture,Free Wi-Fi,On-call staff assistance',
                'room_features' => '1 Accessible Bathroom,4 Wall outlets,1 TV,2 Armchairs,1 Phone,1 Hairdryer',
                'room_status' => 'available',
                'room_image' => 'placeholder.png',
            ],
            [
                'room_number' => '10',
                'room_type' => 'Honeymoon Suite',
                'room_price' => 6500,
                'room_description' => 'Romantic suite with canopy king bed, mood lighting, tub for two, complimentary wine, and room service.',
                'room_pax' => 2,
                'room_inclusions' => 'Complimentary bottle of wine,Romantic room decor with rose petals,Breakfast in bed,Private tub for two,Mood lighting control,24/7 room service,Welcome dessert plate',
                'room_features' => '1 Bathroom with tub,6 Wall outlets,1 Mini bar,1 TV,2 Armchairs,1 Iron and ironing board,1 Phone,1 Hairdryer',
                'room_status' => 'available',
                'room_image' => 'placeholder.png',
            ],
        ]);
    }
} 