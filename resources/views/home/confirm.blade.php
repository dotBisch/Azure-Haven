<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="icon" href="{{ asset('Admin/assets/AzureHaven_Logo_2.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('confirm-payment.css') }}">
</head>
<body>
    <div class="payment">
        <div class="payment-container">
            <div class="payment-details">
                <span class="title">Confirm Your Payment</span>
                <span class="image">
                    <img src="{{ asset('assets/images/ewallet_qr.png') }}" alt="QR Code">
                </span>
                <div class="amount">
                    <span class="amount-title">Amount:</span>
                    <span class="price" style="font-size:2.2rem;font-family:'Playfair Display',serif;">
                        ₱ {{ $booking ? number_format($booking->total_amount, 2) : '0.00' }}
                    </span>
                </div>
                <form action="{{ route('success') }}" method="GET" style="width:100%;display:flex;justify-content:center;">
                    <button type="submit" class="confirm-btn">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>