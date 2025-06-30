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
                <button id="credit-card-btn" class="payment-option-btn active">Credit/Debit Card</button>
                <button id="ewallet-btn" class="payment-option-btn">E-wallet</button>
            </div>

            <!-- Credit Card Details (Initially Hidden) -->
            <div id="credit-card-info" class="payment-details active">
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
            <div id="ewallet-info" class="payment-details">
                <div class="ewallet-options">
                    <button class="ewallet-btn"><img src="{{ asset('assets/images/paypal_logo.png') }}" alt="PayPal"></button>
                    <button class="ewallet-btn"><img src="{{ asset('assets/images/grabpay_logo.png') }}" alt="GrabPay"></button>
                    <button class="ewallet-btn"><img src="{{ asset('assets/images/maya_logo.png') }}" alt="Maya"></button>
                    <button class="ewallet-btn"><img src="{{ asset('assets/images/gcash_logo.png') }}" alt="GCash"></button>
                </div>
            </div>
        </section>
    </div>

    <!-- Right Column: Order Summary -->
    <div class="order-summary">
        <div class="summary-card">
            <div class="summary-header">
                <h3>Total: <strong>₱ 42,500.00</strong> <small>2 items</small></h3>
                <button class="delete-cart-btn" title="Delete Cart" style="background:none;border:none;cursor:pointer;padding:0 0.5rem;">
                    <svg width="22" height="22" fill="var(--primary-blue)" viewBox="0 0 16 16"><path d="M5.5 5.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0v-5a.5.5 0 0 1 .5-.5zm2.5.5a.5.5 0 0 0-1 0v5a.5.5 0 0 0 1 0v-5zm2 .5a.5.5 0 0 1 .5-.5.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0v-5z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2h3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3a.5.5 0 0 0 0 1H3v9a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V4h.5a.5.5 0 0 0 0-1h-13z"/></svg>
                </button>
            </div>
            <div class="summary-items-list">
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
            </div>

            <div class="additional-services">
                <h4>Transportation Services</h4>
                <ul>
                    <li><label><input type="checkbox" value="1" data-price="1200"> Regular Car - Pick-up</label><span>₱ 1,200</span></li>
                    <li><label><input type="checkbox" value="2" data-price="1200"> Regular Car - Drop-off</label><span>₱ 1,200</span></li>
                    <li><label><input type="checkbox" value="3" data-price="2000"> Van - Pick-up</label><span>₱ 2,000</span></li>
                    <li><label><input type="checkbox" value="4" data-price="2000"> Van - Drop-off</label><span>₱ 2,000</span></li>
                </ul>
            </div>

            <div class="additional-services">
                <h4>Massage Services</h4>
                <ul>
                    <li><label><input type="checkbox" value="5" data-price="800"> Relaxation Massage</label><span>₱ 800</span></li>
                    <li><label><input type="checkbox" value="6" data-price="1200"> Tissue Massage</label><span>₱ 1,200</span></li>
                    <li><label><input type="checkbox" value="7" data-price="2000"> Couples Massage</label><span>₱ 2,000</span></li>
                </ul>
            </div>

            <div class="final-total">
                <h3>Total:</h3>
                <h2>₱ 42,500.00</h2>
            </div>
            
            @if ($errors->any())
                <div style="color: red; margin-bottom: 1rem;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="checkout-form" action="{{ route('user.checkout') }}" method="POST">
                @csrf
                <!-- Hidden fields for booking/cart data will be added here by JS or server-side -->
                <button type="submit" class="checkout-btn">Checkout</button>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('payment.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkoutForm = document.getElementById('checkout-form');
    const customerInfoForm = document.querySelector('.customer-info-form');
    const creditCardBtn = document.getElementById('credit-card-btn');
    const ewalletBtn = document.getElementById('ewallet-btn');
    const creditCardInfo = document.getElementById('credit-card-info');
    const ewalletInfo = document.getElementById('ewallet-info');
    const ewalletOptions = ewalletInfo ? ewalletInfo.querySelectorAll('.ewallet-btn') : [];
    const paymentOptionBtns = document.querySelectorAll('.payment-option-btn');

    // Track selected payment method
    let selectedPayment = 'credit'; // default
    if (creditCardBtn && ewalletBtn) {
        creditCardBtn.addEventListener('click', function(e) {
            e.preventDefault();
            selectedPayment = 'credit';
            creditCardBtn.classList.add('active');
            ewalletBtn.classList.remove('active');
            creditCardInfo.classList.add('active');
            ewalletInfo.classList.remove('active');
        });
        ewalletBtn.addEventListener('click', function(e) {
            e.preventDefault();
            selectedPayment = 'ewallet';
            ewalletBtn.classList.add('active');
            creditCardBtn.classList.remove('active');
            ewalletInfo.classList.add('active');
            creditCardInfo.classList.remove('active');
        });
    }

    if (checkoutForm && customerInfoForm) {
        checkoutForm.addEventListener('submit', function(e) {
            // Validate contact info
            const requiredFields = customerInfoForm.querySelectorAll('input[required]');
            let allFilled = true;
            requiredFields.forEach(function(input) {
                if (!input.value.trim()) {
                    allFilled = false;
                    input.classList.add('input-error');
                } else {
                    input.classList.remove('input-error');
                }
            });
            if (!allFilled) {
                e.preventDefault();
                alert('Please fill in all required contact details before proceeding to checkout.');
                return;
            }

            // Validate payment method
            if (selectedPayment === 'credit') {
                // Require all credit card fields
                const cardFields = creditCardInfo.querySelectorAll('input');
                let cardFilled = true;
                cardFields.forEach(function(input) {
                    if (!input.value.trim()) {
                        cardFilled = false;
                        input.classList.add('input-error');
                    } else {
                        input.classList.remove('input-error');
                    }
                });
                if (!cardFilled) {
                    e.preventDefault();
                    alert('Please fill in all credit/debit card details.');
                    return;
                }
            } else if (selectedPayment === 'ewallet') {
                // Require one e-wallet option selected
                let ewalletSelected = false;
                ewalletOptions.forEach(function(btn) {
                    if (btn.classList.contains('ewallet-active')) {
                        ewalletSelected = true;
                    }
                });
                if (!ewalletSelected) {
                    e.preventDefault();
                    alert('Please select an E-wallet option.');
                    return;
                }
            }
        });
    }
});
</script>
@include('home.footer')