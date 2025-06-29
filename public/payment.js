// payment.js

document.addEventListener('DOMContentLoaded', function() {
    // Read cart data from localStorage
    let cart = [];
    try {
        cart = JSON.parse(localStorage.getItem('azureHavenCart')) || [];
    } catch (e) {
        cart = [];
    }

    // Read checkin/checkout/nights from localStorage (set on availability page)
    const checkin = localStorage.getItem('azureHavenCheckin') || '-';
    const checkout = localStorage.getItem('azureHavenCheckout') || '-';
    const nights = parseInt(localStorage.getItem('azureHavenNights')) || 1;

    // Populate summary card
    const summaryCard = document.querySelector('.summary-card');
    if (!summaryCard) return;

    // Helper to format price
    function formatPrice(num) {
        return '₱ ' + Number(num).toLocaleString('en-PH', {minimumFractionDigits: 2});
    }

    // Build summary items
    let total = 0;
    let itemsHtml = '';
    cart.forEach(item => {
        const subtotal = item.price * nights;
        total += subtotal;
        itemsHtml += `
        <div class="summary-item">
            <h4>${item.type}</h4>
            <div class="item-detail"><span><svg width="12" height="12" viewBox="0 0 12 12"><path d="M6 6a2 2 0 100-4 2 2 0 000 4zM2 11s-1-1-1-2 2-4 5-4 5 3 5 5-1 2-1 2H2z"></path></svg>Guest: ${item.pax}</span></div>
            <div class="item-detail"><strong>Check In:</strong> <span>${checkin}</span></div>
            <div class="item-detail"><strong>Check Out:</strong> <span>${checkout}</span></div>
            <div class="item-detail"><strong>Guests:</strong> <span>${item.guests || 1} pax</span></div>
            <div class="item-price"><strong>${nights} Night${nights>1?'s':''}</strong><span>${formatPrice(subtotal)}</span></div>
        </div>
        `;
    });

    // Update summary card
    summaryCard.querySelector('.summary-header h3').innerHTML = `Total: <strong>${formatPrice(total)}</strong> <small>${cart.length} item${cart.length!==1?'s':''}</small>`;
    const itemsList = summaryCard.querySelector('.summary-items-list');
    if (itemsList) itemsList.innerHTML = itemsHtml;

    // Helper to enable/disable service checkboxes
    function setServiceCheckboxesEnabled(enabled) {
        document.querySelectorAll('.additional-services input[type="checkbox"]').forEach(cb => {
            cb.disabled = !enabled;
            if (!enabled) cb.checked = false;
        });
    }

    // After rendering summary, set checkbox state
    setServiceCheckboxesEnabled(cart.length > 0);

    // Calculate and update final total (including services)
    function updateFinalTotal() {
        let serviceTotal = 0;
        document.querySelectorAll('.additional-services input[type="checkbox"]:checked').forEach(cb => {
            serviceTotal += Number(cb.dataset.price || 0);
        });
        summaryCard.querySelector('.final-total h2').textContent = formatPrice(total + serviceTotal);
    }
    // Initial call
    updateFinalTotal();
    // Listen for changes
    document.querySelectorAll('.additional-services input[type="checkbox"]').forEach(cb => {
        cb.addEventListener('change', updateFinalTotal);
    });

    // Delete cart functionality
    const deleteBtn = summaryCard.querySelector('.delete-cart-btn');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            localStorage.removeItem('azureHavenCart');
            localStorage.removeItem('azureHavenCheckin');
            localStorage.removeItem('azureHavenCheckout');
            localStorage.removeItem('azureHavenNights');
            // Uncheck and disable all services
            setServiceCheckboxesEnabled(false);
            // Clear summary
            if (itemsList) itemsList.innerHTML = '';
            summaryCard.querySelector('.summary-header h3').innerHTML = 'Total: <strong>₱ 0.00</strong> <small>0 items</small>';
            summaryCard.querySelector('.final-total h2').textContent = '₱ 0.00';
        });
    }

    // Optionally, clear cart on successful checkout
    // document.querySelector('.checkout-btn').addEventListener('click', function() {
    //     localStorage.removeItem('azureHavenCart');
    // });

    // Payment method toggle logic
    const creditBtn = document.getElementById('credit-card-btn');
    const ewalletBtn = document.getElementById('ewallet-btn');
    const creditInfo = document.getElementById('credit-card-info');
    const ewalletInfo = document.getElementById('ewallet-info');
    if (creditBtn && ewalletBtn && creditInfo && ewalletInfo) {
        creditBtn.addEventListener('click', function(e) {
            e.preventDefault();
            creditBtn.classList.add('active');
            ewalletBtn.classList.remove('active');
            creditInfo.classList.add('active');
            ewalletInfo.classList.remove('active');
        });
        ewalletBtn.addEventListener('click', function(e) {
            e.preventDefault();
            ewalletBtn.classList.add('active');
            creditBtn.classList.remove('active');
            ewalletInfo.classList.add('active');
            creditInfo.classList.remove('active');
        });
    }

    // Card expiry validation (MM/YYYY)
    document.querySelectorAll('.form-group.expiry input').forEach(input => {
        input.addEventListener('input', function() {
            if (this.placeholder === 'MM' && (this.value.length > 2 || Number(this.value) < 1 || Number(this.value) > 12)) {
                this.value = '';
            }
            if (this.placeholder === 'YYYY' && this.value.length > 4) {
                this.value = this.value.slice(0, 4);
            }
        });
    });

    // E-wallet selection logic
    const ewalletBtns = document.querySelectorAll('.ewallet-btn');
    ewalletBtns.forEach(btn => {
        btn.classList.remove('ewallet-active'); // Ensure none are selected by default
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            ewalletBtns.forEach(b => b.classList.remove('ewallet-active'));
            this.classList.add('ewallet-active');
        });
    });

    // --- Add logic to populate checkout form hidden fields ---
    const checkoutForm = document.getElementById('checkout-form');
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', function(e) {
            // Remove any previous hidden fields except CSRF token
            Array.from(checkoutForm.querySelectorAll('input[type="hidden"]')).forEach(el => {
                if (el.name !== '_token') el.remove();
            });

            // Only support single-room booking for now (first item in cart)
            const item = cart[0];
            if (item) {
                // Room ID
                const roomIdInput = document.createElement('input');
                roomIdInput.type = 'hidden';
                roomIdInput.name = 'room_id';
                roomIdInput.value = item.id;
                checkoutForm.appendChild(roomIdInput);

                // Guests
                const guestsInput = document.createElement('input');
                guestsInput.type = 'hidden';
                guestsInput.name = 'guests';
                guestsInput.value = item.guests || 1;
                checkoutForm.appendChild(guestsInput);

                // Number of rooms (always 1 for now)
                const roomsInput = document.createElement('input');
                roomsInput.type = 'hidden';
                roomsInput.name = 'rooms';
                roomsInput.value = 1;
                checkoutForm.appendChild(roomsInput);
            }
            // Check-in/out
            const checkinInput = document.createElement('input');
            checkinInput.type = 'hidden';
            checkinInput.name = 'check_in_date';
            checkinInput.value = checkin;
            checkoutForm.appendChild(checkinInput);

            const checkoutInput = document.createElement('input');
            checkoutInput.type = 'hidden';
            checkoutInput.name = 'check_out_date';
            checkoutInput.value = checkout;
            checkoutForm.appendChild(checkoutInput);

            // Add selected services
            const selectedServices = Array.from(document.querySelectorAll('.additional-services input[type="checkbox"]:checked'));
            selectedServices.forEach(cb => {
                const serviceInput = document.createElement('input');
                serviceInput.type = 'hidden';
                serviceInput.name = 'services[]';
                serviceInput.value = cb.value || cb.getAttribute('data-id') || cb.getAttribute('data-price'); // Preferably use service ID
                checkoutForm.appendChild(serviceInput);
            });
        });
    }

    // On page load, if cart has an item, update the URL with cart info for backend check
    if (cart.length > 0) {
        const item = cart[0];
        const params = new URLSearchParams({
            room_id: item.id,
            check_in_date: checkin,
            check_out_date: checkout
        });
        const currentUrl = window.location.pathname + '?' + params.toString();
        if (window.location.search !== '?' + params.toString()) {
            window.location.replace(currentUrl);
        }
    }
}); 