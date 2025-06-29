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

    $roomTypeToId = [
        'Deluxe Queen Room' => 'deluxe-queen',
        'Superior Twin Room' => 'superior-twin',
        'Executive King Suite' => 'executive-king',
        'Family Room' => 'family',
        'Budget Single Room' => 'budget-single',
        'Junior Suite' => 'junior-suite',
        'Penthouse Suite' => 'penthouse-suite',
        'Barkada Room' => 'barkada',
        'Accessible Room' => 'accessible',
        'Honeymoon Suite' => 'honeymoon-suite',
        // Add more mappings as needed
    ];
@endphp

@include('home.header')
<link rel="stylesheet" href="{{ asset('availability.css') }}">

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
        <div class="room-grid-2col">
            <div class="room-list-col">
                <div class="room-grid">
                    @forelse($availableRooms as $room)
                        <div class="room-card">
                            <div class="card-body">
                                <img src="assets/images/{{ getRoomImage($room->room_type, $roomImages) }}" alt="{{ $room->room_type }}">
                                <div class="room-info">
                                    <button class="select-room-btn"
                                        data-room-id="{{ $room->id }}"
                                        data-room-type="{{ $room->room_type }}"
                                        data-room-price="{{ $room->room_price }}"
                                        data-room-pax="{{ $room->room_pax }}"
                                        data-room-img="assets/images/{{ getRoomImage($room->room_type, $roomImages) }}"
                                        data-room-description="{{ $room->room_description }}"
                                    >Select Room</button>
                                    <div class="price-tag">₱ {{ number_format($room->room_price, 0) }} <span>/night</span></div>
                                    <h3>{{ $room->room_type }}</h3>
                                    <p>{{ $room->room_description }}</p>
                                    <div class="guest-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>
                                        Guest: <strong>{{ $room->room_pax }}</strong>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ url('roomsAndServices/room-details') }}?id={{ $roomTypeToId[$room->room_type] ?? strtolower(str_replace(' ', '-', $room->room_type)) }}" class="read-more">Learn More &nbsp;→</a>
                        </div>
                    @empty
                        <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; background: #f8f9fa; border-radius: 12px; border: 2px dashed #ccc;">
                            <p style="margin: 0.5rem 0; color: #666; font-size: 1.1rem;">No rooms found for your criteria.</p>
                            <p style="margin: 0.5rem 0; color: #666; font-size: 1.1rem;">Please try different dates or guest count.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <aside class="cart-col">
                <div class="cart-box">
                    <div class="cart-header">
                        <span class="cart-title"><svg style="vertical-align:middle;margin-right:6px;" width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path d="M6 2a1 1 0 0 0-1 1v1H3.5A1.5 1.5 0 0 0 2 5.5v11A1.5 1.5 0 0 0 3.5 18h13a1.5 1.5 0 0 0 1.5-1.5v-11A1.5 1.5 0 0 0 16.5 4H15V3a1 1 0 0 0-1-1H6zm0 2V3h8v1H6z"/></svg> Total: <span class="cart-total">₱ 0.00</span></span>
                        <span class="cart-items">0 Items</span>
                    </div>
                    <div class="cart-items-list">
                        <div class="cart-placeholder">No rooms selected yet.</div>
                    </div>
                    <div class="cart-footer">
                        <button class="cart-book-btn" disabled>Book</button>
                    </div>
                </div>
            </aside>
        </div>
</div>
</section>

@include('home.footer')

<script>
    const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
    const loginUrl = "{{ route('login') }}";
    const paymentUrl = "{{ route('payment') }}";
</script>

<script>
// --- Cart Logic ---
const cart = [];
const cartBox = document.querySelector('.cart-box');
const cartItemsList = cartBox.querySelector('.cart-items-list');
const cartTotal = cartBox.querySelector('.cart-total');
const cartItemsCount = cartBox.querySelector('.cart-items');
const cartBookBtn = cartBox.querySelector('.cart-book-btn');

// Get check-in/out and nights from PHP variables
const checkin = "{{ $checkin ?? '' }}";
const checkout = "{{ $checkout ?? '' }}";
function getNights() {
    if (!checkin || !checkout) return 1;
    const d1 = new Date(checkin);
    const d2 = new Date(checkout);
    return Math.max(1, Math.round((d2-d1)/(1000*60*60*24)));
}
const nights = getNights();

function formatPrice(num) {
    return '₱ ' + Number(num).toLocaleString('en-PH', {minimumFractionDigits: 2});
}

function updateCartUI() {
    cartItemsList.innerHTML = '';
    if (cart.length === 0) {
        cartItemsList.innerHTML = '<div class="cart-placeholder">No rooms selected yet.</div>';
        cartTotal.textContent = '₱ 0.00';
        cartItemsCount.textContent = '0 Items';
        cartBookBtn.disabled = true;
        return;
    }
    let total = 0;
    cart.forEach((item, idx) => {
        const subtotal = item.price * nights;
        total += subtotal;
        // Build guests dropdown (1 to max pax)
        let guestOptions = '';
        for (let i=1; i<=item.pax; ++i) {
            guestOptions += `<option value="${i}"${i==item.guests?' selected':''}>${i}</option>`;
        }
        const div = document.createElement('div');
        div.className = 'cart-room-item';
        div.innerHTML = `
            <div class="cart-room-header">
                <span class="cart-room-title">${item.type}</span>
                <button class="cart-remove-btn" data-idx="${idx}" title="Remove"><svg width="22" height="22" fill="var(--primary-blue)" viewBox="0 0 16 16"><path d="M5.5 5.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0v-5a.5.5 0 0 1 .5-.5zm2.5.5a.5.5 0 0 0-1 0v5a.5.5 0 0 0 1 0v-5zm2 .5a.5.5 0 0 1 .5-.5.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0v-5z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2h3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3a.5.5 0 0 0 0 1H3v9a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V4h.5a.5.5 0 0 0 0-1h-13z"/></svg></button>
            </div>
            <div class="cart-room-meta">
                <span class="cart-room-pax"><svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg> <b>Guest:</b> ${item.pax}</span>
            </div>
            <div class="cart-room-dates">
                <div><b>Check In:</b> <span>${checkin || '-'}</span></div>
                <div><b>Check Out:</b> <span>${checkout || '-'}</span></div>
            </div>
            <div class="cart-room-nights">
                <span><b>${nights} Night${nights>1?'s':''}</b></span>
                <span class="cart-room-price">${formatPrice(item.price)} x ${nights}</span>
            </div>
            <div class="cart-room-guests">
                <label for="guests-${idx}"><b>Guests:</b></label>
                <select id="guests-${idx}" class="cart-guests-select">${guestOptions}</select>
            </div>
            <hr class="cart-divider" />
            <div class="cart-room-subtotal">${formatPrice(subtotal)}</div>
        `;
        // Listen for guest change
        div.querySelector('.cart-guests-select').addEventListener('change', function() {
            item.guests = Number(this.value);
            // If you want subtotal to depend on guests, update subtotal here
            // For now, price is per room, not per guest
        });
        cartItemsList.appendChild(div);
    });
    cartTotal.textContent = formatPrice(total);
    cartItemsCount.textContent = cart.length + (cart.length === 1 ? ' Item' : ' Items');
    cartBookBtn.disabled = cart.length === 0;
}

document.querySelectorAll('.select-room-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const id = this.dataset.roomId;
        // Only allow one room in the cart at a time
        cart.length = 0;
        cart.push({
            id,
            type: this.dataset.roomType,
            price: Number(this.dataset.roomPrice),
            pax: this.dataset.roomPax,
        });
        updateCartUI();
    });
});

cartItemsList.addEventListener('click', function(e) {
    if (e.target.closest('.cart-remove-btn')) {
        const idx = e.target.closest('.cart-remove-btn').dataset.idx;
        cart.splice(idx, 1);
        updateCartUI();
    }
});

cartBookBtn.addEventListener('click', function() {
    if (!this.disabled) {
        // Save cart and booking info to localStorage
        localStorage.setItem('azureHavenCart', JSON.stringify(cart));
        localStorage.setItem('azureHavenCheckin', checkin);
        localStorage.setItem('azureHavenCheckout', checkout);
        localStorage.setItem('azureHavenNights', nights);
        if (isLoggedIn) {
            window.location.href = paymentUrl;
        } else {
            window.location.href = loginUrl;
        }
    }
});

// Initial UI
updateCartUI();
</script>