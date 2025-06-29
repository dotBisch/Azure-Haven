@include('home.header')
<link rel="stylesheet" href="{{ asset('payment.css') }}">

<div class="booking-container">
    <!-- Left Column: Booking Details -->
    <div class="booking-details">
        <div class="main-title">
            <h1>Booking</h1>
            <div class="title-underline"></div>
        </div>

        <!-- Customer Information -->
        <section class="info-section">
            <h2>Customer Information</h2>
            <form class="customer-info-form">
                <div class="form-row">
                    <div class="form-group"><input type="text" placeholder="First Name" required></div>
                    <div class="form-group"><input type="text" placeholder="Last Name" required></div>
                </div>
                <div class="form-row">
                    <div class="form-group"><input type="email" placeholder="Email:" required></div>
                    <div class="form-group"><input type="tel" placeholder="Phone Number:" required></div>
                </div>
                <div class="form-group"><input type="text" placeholder="Address:" required></div>
                <div class="form-row">
                    <div class="form-group"><input type="text" placeholder="City:" required></div>
                    <div class="form-group"><input type="text" placeholder="State:" required></div>
                </div>
                <div class="form-group"><input type="text" placeholder="Country:" required></div>
            </form>
        </section>

        <!-- Payment Method -->
        <section class="payment-section">
            <h2>Payment Method</h2>
            <div class="payment-options">
                <button id="credit-card-btn" class="payment-option-btn">
                    Credit/Debit Card
                </button>
                <button id="ewallet-btn" class="payment-option-btn active">
                    E-wallet
                </button>
            </div>

            <!-- Credit Card Details (Initially Hidden) -->
            <div id="credit-card-info" class="payment-details">
                <form class="payment-form">
                    <div class="form-group"><input type="text" placeholder="Card Number:"></div>
                    <div class="form-row">
                        <div class="form-group"><input type="text" placeholder="First Name:"></div>
                        <div class="form-group"><input type="text" placeholder="Last Name:"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group cvv"><input type="text" placeholder="CVV:"></div>
                        <div class="form-group expiry">
                            <label>Expiry Date:</label>
                            <input type="text" placeholder="MM">
                            <input type="text" placeholder="YYYY">
                        </div>
                    </div>
                    <h4>Billing Address</h4>
                    <p class="form-note">We ask this information to protect our customers from online fraud.</p>
                    <div class="form-group"><input type="text" placeholder="Street Address:"></div>
                    <div class="form-row">
                        <div class="form-group"><input type="text" placeholder="City/Town:"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><input type="text" placeholder="Country:"></div>
                        <div class="form-group"><input type="text" placeholder="Zip Code:"></div>
                    </div>
                    <h4>Contact Number</h4>
                    <div class="form-row">
                        <div class="form-group"><input type="tel" placeholder="Phone Number:"></div>
                        <div class="form-group"><input type="email" placeholder="Email:"></div>
                    </div>
                </form>
            </div>

            <!-- E-wallet Details (Initially Visible) -->
            <div id="ewallet-info" class="payment-details active">
                <div class="ewallet-options">
                    <button class="ewallet-btn"><img src="/assets/images/booking/paypal.png" alt="PayPal"></button>
                    <button class="ewallet-btn"><img src="/assets/images/booking/grabpay.png" alt="GrabPay"></button>
                    <button class="ewallet-btn"><img src="/assets/images/booking/maya.png" alt="Maya"></button>
                    <button class="ewallet-btn"><img src="/assets/images/booking/gcash.png" alt="GCash"></button>
                </div>
            </div>
        </section>
    </div>

    <!-- Right Column: Order Summary -->
    <div class="order-summary">
        <div class="summary-card">
            <div class="summary-header">
                <h3>Total: <strong>₱ 42,500.00</strong> <small>2 items</small></h3>
                <a href="#" class="edit-link">Edit</a>
            </div>

            <div class="summary-item">
                <h4>Barkada Room</h4>
                <div class="item-detail"><span><svg width="12" height="12" viewBox="0 0 12 12"><path d="M6 6a2 2 0 100-4 2 2 0 000 4zM2 11s-1-1-1-2 2-4 5-4 5 3 5 5-1 2-1 2H2z"></path></svg>Guest: 8</span></div>
                <div class="item-detail"><strong>Check In:</strong> <span>10/25/2025</span></div>
                <div class="item-detail"><strong>Check Out:</strong> <span>10/30/2025</span></div>
                <div class="item-detail"><strong>Guests:</strong> <span>5 pax</span></div>
                <div class="item-price"><strong>5 Nights</strong><span>₱ 19,000.00</span></div>
            </div>
            
            <div class="summary-item">
                <h4>Family Room</h4>
                <div class="item-detail"><span><svg width="12" height="12" viewBox="0 0 12 12"><path d="M6 6a2 2 0 100-4 2 2 0 000 4zM2 11s-1-1-1-2 2-4 5-4 5 3 5 5-1 2-1 2H2z"></path></svg>Guest: 4</span></div>
                <div class="item-detail"><strong>Check In:</strong> <span>10/25/2025</span></div>
                <div class="item-detail"><strong>Check Out:</strong> <span>10/30/2025</span></div>
                <div class="item-detail"><strong>Guests:</strong> <span>3 pax</span></div>
                <div class="item-price"><strong>5 Nights</strong><span>₱ 23,500.00</span></div>
            </div>

            <div class="additional-services">
                <h4>Transportation Services</h4>
                <ul>
                    <li><label><input type="checkbox"> Regular Car - Pick-up</label><span>₱ 1,200</span></li>
                    <li><label><input type="checkbox"> Regular Car - Drop-off</label><span>₱ 1,200</span></li>
                    <li><label><input type="checkbox"> Van - Pick-up</label><span>₱ 2,000</span></li>
                    <li><label><input type="checkbox"> Van - Drop-off</label><span>₱ 2,000</span></li>
                </ul>
            </div>

            <div class="additional-services">
                <h4>Massage Services</h4>
                <ul>
                    <li><label><input type="checkbox"> Relaxation Massage</label><span>₱ 800</span></li>
                    <li><label><input type="checkbox"> Tissue Massage</label><span>₱ 1,200</span></li>
                    <li><label><input type="checkbox"> Couples Massage</label><span>₱ 2,000</span></li>
                </ul>
            </div>

            <div class="final-total">
                <h3>Total:</h3>
                <h2>₱ 42,500.00</h2>
            </div>
            
            <button class="checkout-btn">Checkout</button>
        </div>
    </div>
</div>

@include('home.footer')