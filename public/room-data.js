const roomData = [
    {
        id: 'deluxe-queen',
        name: 'Deluxe Queen Room',
        price: '₱3,200',
        guests: 2,
        description: 'Elegant room with a queen-size bed, city view, private bath, and workspace. Ideal for solo travelers or couples.',
        heroImage: 'assets/images/room-details/room_details_hero.png',
        gallery: [
            'assets/images/room-details/deluxe1.png',
            'assets/images/room-details/deluxe2.png',
        ],
        features: [
            '1 Bathroom', '2 Wall outlets', '1 Mini bar', '1 TV',
            '1 Armchair', '1 Iron and ironing board', '1 Phone', '1 Hairdryer'
        ],
        inclusions: [
            'Complimentary Wi-Fi', 'Daily housekeeping', 'Coffee & tea making facilities',
            'Air-conditioning', 'Toiletries & towels'
        ]
    },
    {
        id: 'superior-twin',
        name: 'Superior Twin Room',
        price: '₱3,500',
        guests: 2,
        description: 'Two cozy single beds with modern decor, smart TV, and free breakfast. Great for friends or work trips.',
        heroImage: 'assets/images/room-details/room_details_hero.png',
        gallery: [
            'assets/images/room-details/superior1.png',
            'assets/images/room-details/superior2.png'

        ],
        features: ['2 Single Beds', '42-inch Smart TV', 'Work Desk', 'In-room Safe', 'Mini-fridge', 'Wardrobe'],
        inclusions: ['Free Breakfast for two', 'Complimentary Wi-Fi', 'Daily housekeeping', 'Bottled Water', 'Toiletries & towels']
    },
    {
        id: 'executive-king',
        name: 'Executive King Suite',
        price: '₱5,800',
        guests: 2,
        description: 'Spacious suite with king-size bed, living area, large windows, mini bar, and premium toiletries.',
        heroImage: 'assets/images/room-details/room_details_hero.png',
        gallery: [
            'assets/images/room-details/executive1.png',
            'assets/images/room-details/executive2.png'
        ],
        features: ['King-size Bed', 'Separate Living Area', 'Panoramic Windows', 'Rainfall Shower', '50-inch Smart TV', 'Espresso Machine'],
        inclusions: ['Premium Toiletries', 'Bathrobes & Slippers', 'Complimentary Wi-Fi', 'Welcome Drink', 'Daily housekeeping']
    },
    {
        id: 'family',
        name: 'Family Room',
        price: '₱4,700',
        guests: 4,
        description: 'One queen bed and two single beds, perfect for small families. Comes with Netflix-ready smart TV and fridge.',
        heroImage: 'assets/images/room-details/room_details_hero.png',
        gallery: [
            'assets/images/room-details/family1.png',
            'assets/images/room-details/family2.png'
        ],
        features: ['1 Queen Bed', '2 Single Beds', 'Netflix-ready TV', 'Mini-fridge', 'Microwave', 'Dining Nook'],
        inclusions: ['Complimentary Wi-Fi', 'Board Games on request', 'Daily housekeeping', 'Toiletries & towels']
    },
    {
        id: 'budget-single',
        name: 'Budget Single Room',
        price: '₱1,500',
        guests: 1,
        description: 'Compact but clean and modern room with single bed, private shower, and desk. Great for short stays.',
        heroImage: 'assets/images/room-details/room_details_hero.png',
        gallery: [
            'assets/images/room-details/budget1.png',
            'assets/images/room-details/budget2.png'
        ],
        features: ['1 Single Bed', 'Private Shower', 'Writing Desk', 'Air-conditioning', 'Wall-mounted TV', 'Blackout Curtains'],
        inclusions: ['Complimentary Wi-Fi', 'Daily housekeeping', 'Basic Toiletries', 'Access to common pantry']
    },
    {
        id: 'junior-suite',
        name: 'Junior Suite',
        price: '₱4,200',
        guests: 2,
        description: 'Stylish room with queen bed, small living area, bath tub, and balcony view.',
        heroImage: 'assets/images/room-details/room_details_hero.png',
        gallery: [
            'assets/images/room-details/junior1.png',
            'assets/images/room-details/junior2.png'
        ],
        features: ['Queen-size Bed', 'Small Living Area', 'Private Balcony', 'Bathtub', 'City or Sea View', 'Plush Sofa'],
        inclusions: ['Complimentary Wi-Fi', 'Daily housekeeping', 'Upgraded Toiletries', 'Welcome Fruit Platter', 'Bathrobes']
    },
    {
        id: 'penthouse-suite',
        name: 'Penthouse Suite',
        price: '₱12,000',
        guests: 2,
        description: 'Top-floor luxury suite with panoramic seaside view, king bed, sofa lounge, Jacuzzi, and dedicated concierge.',
        heroImage: 'assets/images/room-details/room_details_hero.png',
        gallery: [
            'assets/images/room-details/penthouse1.png',
            'assets/images/room-details/penthouse2.png'
        ],
        features: ['Top-floor Location', 'Panoramic Seaside View', 'King Bed', 'Sofa Lounge', 'Private Jacuzzi', 'Dining Area'],
        inclusions: ['Dedicated Concierge', 'Exclusive Lounge Access', 'Complimentary Breakfast', 'Evening Cocktails', 'Limousine Service']
    },
    {
        id: 'barkada',
        name: 'Barkada Room',
        price: '₱3,800',
        guests: 8,
        description: 'Dorm-style room with 4 bunk beds, shared bath, lockers, and common lounge area.',
        heroImage: 'assets/images/room-details/room_details_hero.png',
        gallery: [
            'assets/images/room-details/barkada1.png',
            'assets/images/room-details/barkada2.png'
        ],
        features: ['4 Bunk Beds', '8 Personal Lockers', 'Shared Bathroom', 'Common Lounge Access', 'USB Charging Ports', 'Reading Lights'],
        inclusions: ['High-speed Wi-Fi', 'Linen & Towels', 'Access to common kitchen', 'Daily housekeeping of common areas']
    },
    {
        id: 'accessible',
        name: 'Accessible Room',
        price: '₱2,900',
        guests: 2,
        description: 'Queen-size bed with accessible layout, support rails in bathroom, wide doorway, and emergency alert system.',
        heroImage: 'assets/images/room-details/room_details_hero.png',
        gallery: [
            'assets/images/room-details/accessible1.png',
            'assets/images/room-details/accessible2.png'
        ],
        features: ['Wide Doorways (32")', 'Roll-in Shower', 'Support Rails in Bathroom', 'Emergency Alert System', 'Lowered Light Switches', 'Accessible Desk'],
        inclusions: ['Complimentary Wi-Fi', 'Daily housekeeping', 'Wheelchair accessible routes', 'On-call staff assistance']
    },
    {
        id: 'honeymoon-suite',
        name: 'Honeymoon Suite',
        price: '₱6,500',
        guests: 2,
        description: 'Romantic suite with canopy king bed, mood lighting, tub for two, complimentary wine, and room service.',
        heroImage: 'assets/images/room-details/room_details_hero.png',
        gallery: [
            'assets/images/room-details/honeymoon1.png',
            'assets/images/room-details/honeymoon2.png'
        ],
        features: ['Canopy King Bed', 'Mood Lighting System', 'Jacuzzi Tub for Two', 'Private Balcony', 'In-room Sound System', 'Double Vanity Sink'],
        inclusions: ['Complimentary Bottle of Wine', 'Breakfast in Bed', 'Late Check-out', 'Romantic Room Setup on request', 'Couples Massage Discount']
    }
];