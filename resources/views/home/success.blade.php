<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="icon" href="{{ asset('Admin/assets/AzureHaven_Logo_2.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('successful-payment.css') }}">
</head>
<body>
    <div class="payment">
        <div class="payment-container">
            <div class="payment-details">
                <span class="image">
                    <img src="assets/images/check_icon.png" alt="Successful Payment">
                </span>
                <div class="status">
                    <span class="title">Payment Successful!</span>
                    <span class="thanks">Thank you for your transaction.</span>
                </div>
                <a href="{{ route('home') }}" class="confirm-btn" style="display:inline-block;text-align:center;">Complete</a>
            </div>
        </div>
    </div>
</body>
</html>