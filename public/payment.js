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

    // Optionally, clear cart on successful checkout
    // document.querySelector('.checkout-btn').addEventListener('click', function() {
    //     localStorage.removeItem('azureHavenCart');
    // });
}); 