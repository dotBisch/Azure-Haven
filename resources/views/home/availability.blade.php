@php
    $roomImages = [
        'accessible' => 'accessible.png',
        'barkada' => 'barkada.png',
        'budget' => 'budget.png',
        'deluxe' => 'deluxe.png',
        'executive' => 'executive.png',
        'family' => 'family.png',
        'honeymoon' => 'honeymoon.png',
        'junior' => 'junior.png',
        'penthouse' => 'penthouse.png',
        'superior' => 'superior.png',
    ];
    function getRoomImage($type, $roomImages) {
        $type = strtolower($type);
        foreach ($roomImages as $key => $img) {
            if (str_contains($type, $key)) {
                return $img;
            }
        }
        return 'room-details/room_details_hero.png';
    }
@endphp

@include('home.header')
<link rel="stylesheet" href="{{ asset('rooms.css') }}">
<link rel="stylesheet" href="{{ asset('home.css') }}">

<div class="hero-section"></div>
@include('home.booking')

<section class="rooms-section">
    <div class="container">
        <h2>Available <span>Rooms</span></h2><hr>
        @if(isset($checkin) && isset($checkout))
            <p class="section-intro">Search Results for: {{ $checkin }} to {{ $checkout }} | {{ $guests }} Guest(s) | {{ $numberOfRooms }} Room(s)</p>
        @else
            <p class="section-intro">Choose from our thoughtfully designed rooms—each one a blend of style, comfort, and tranquility for a truly relaxing stay.</p>
        @endif
        
        <div class="room-grid">
            @forelse($availableRooms as $room)
                <div class="room-card">
                    <div class="card-body">
                        <img src="assets/images/{{ getRoomImage($room->room_type, $roomImages) }}" alt="{{ $room->room_type }}">
                        <div class="room-info">
                            <div class="price-tag">₱ {{ number_format($room->room_price, 0) }} <span>/night</span></div>
                            <h3>{{ $room->room_type }}</h3>
                            <p>{{ $room->room_description }}</p>
                            <div class="guest-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>
                                Guest: <strong>{{ $room->room_pax }}</strong>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('roomsAndServices/room-details') }}?id={{ strtolower(str_replace(' ', '-', $room->room_type)) }}" class="read-more">Read More →</a>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; background: #f8f9fa; border-radius: 12px; border: 2px dashed #ccc;">
                    <p style="margin: 0.5rem 0; color: #666; font-size: 1.1rem;">No rooms found for your criteria.</p>
                    <p style="margin: 0.5rem 0; color: #666; font-size: 1.1rem;">Please try different dates or guest count.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@include('home.footer')