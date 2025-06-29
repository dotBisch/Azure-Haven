<section class="booking-section">
    <div class="booking-container">
        <p>Ready to Relax?</p>
        <h2><span class="highlight-blue">Book</span> your room today!</h2>
        <form class="booking-form" action="{{ route('userbookings') }}" method="GET">
            <div class="form-group">
                <label for="checkin">Check-In</label>
                <input type="date" id="checkin" name="checkin" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
            </div>
            <div class="form-group">
                <label for="checkout">Check-Out</label>
                <input type="date" id="checkout" name="checkout" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
            </div>
            <div class="form-group">
                <label for="guests">Guests</label>
                <select id="guests" name="guests" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select>
            </div>
            <div class="form-group">
                <label for="rooms">Rooms</label>
                <select id="rooms" name="rooms" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <button type="submit" class="search-btn">Check Availability</button>
        </form>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    
    // Set minimum checkout date when checkin date changes
    checkinInput.addEventListener('change', function() {
        if (this.value) {
            const nextDay = new Date(this.value);
            nextDay.setDate(nextDay.getDate() + 1);
            checkoutInput.min = nextDay.toISOString().split('T')[0];
            
            // If checkout date is before checkin date, clear it
            if (checkoutInput.value && checkoutInput.value <= this.value) {
                checkoutInput.value = '';
            }
        }
    });
    
    // Ensure checkout date is after checkin date
    checkoutInput.addEventListener('change', function() {
        if (checkinInput.value && this.value <= checkinInput.value) {
            alert('Check-out date must be after check-in date');
            this.value = '';
        }
    });
});
</script>