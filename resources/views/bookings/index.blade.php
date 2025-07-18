<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azure Haven</title>
    <link rel="icon" href="{{ asset('Admin/assets/AzureHaven_Logo_2.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('history.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Manuale:700,400&display=swap" rel="stylesheet">

</head>
<body>
    
    <!-- Header -->
    <header class="main-header">
        <div class="header-container">
            <a href="{{ route('home') }}" class="logo">
                <img src="assets/images/azure_logo.png" alt="Azure Haven Logo">
            </a>
        </div>
    </header>

    <!-- History Section -->
    <div class="history">
        <div class="history-container">
            <div class="title">
                <h2>Your <span class="highlight-blue">Bookings</span></h2><hr class="divider">
                <p>View a history of your past bookings, including details of your previous stays and reservation information.</p>
            </div>

            <div class="card-wrapper">
                @forelse($bookings as $booking)
                <div class="date">
                    <span>{{ \Carbon\Carbon::parse($booking->created_at)->format('F d, Y') }}</span>
                </div>

                <div class="history-card">
                    <div class="summary-item">
                        <h4>{{ $booking->room->room_type ?? 'Room' }}</h4>
                        <div class="item-detail">
                            <div class="left">
                                <strong>Check In:</strong> 
                                <strong>Check Out:</strong>
                            </div>
                            <div class="middle">
                                <span class="checkin">{{ \Carbon\Carbon::parse($booking->check_in_date)->format('m/d/Y') }}</span>
                                <span class="checkout">{{ \Carbon\Carbon::parse($booking->check_out_date)->format('m/d/Y') }}</span>
                            </div>
                            <div class="right">
                                <span></span>
                                <span></span>
                            </div>
                        </div>

                        <div class="item-detail">
                            <div class="left">
                                <span>&nbsp;</span>
                                <strong>Guest:</strong>                             
                            </div>
                            <div class="middle">
                                <span class="night"><strong>{{ (new \Carbon\Carbon($booking->check_in_date))->diffInDays(new \Carbon\Carbon($booking->check_out_date)) }} nights</strong></span>
                                <span class="guest"><strong>{{ $booking->room->room_pax ?? '-' }} pax</strong></span>
                            </div>
                            <div class="right">
                                <span class="night-price"><strong>₱ {{ number_format($booking->total_amount, 2) }}</strong></span>
                            </div>
                        </div>

                        <hr>

                        <div class="additional-services">
                            <h5>Additional Services</h5>
                            @php
                                $transport = $booking->services->whereIn('service_name', ['Regular Car – Pick-up', 'Regular Car – Drop-off', 'Van – Pick-up', 'Van – Drop-off']);
                                $massage = $booking->services->whereIn('service_name', ['Relaxation Massage', 'Therapeutic Deep Tissue Massage', 'Couples Massage']);
                            @endphp
                            <span class="add-title">Transportation Services</span>
                            @foreach($transport as $service)
                            <div class="t-add">
                                <span class="t-service">{{ $service->service_name }}</span>
                                <span class="t-price"><strong>₱ {{ number_format($service->service_price, 2) }}</strong></span>
                            </div>
                            @endforeach
                            <span class="add-title">Massage Services</span>
                            @foreach($massage as $service)
                            <div class="m-add">
                                <span class="m-service">{{ $service->service_name }}</span>
                                <span class="m-price"><strong>₱ {{ number_format($service->service_price, 2) }}</strong></span>
                            </div>
                            @endforeach
                        </div>

                        <hr>

                        <div class="subtotal">
                            <span class="subtotal-value">₱ {{ number_format($booking->total_amount, 2) }}</span>
                        </div>

                    </div>
                </div>
                @empty
                <div style="text-align:center; padding:2rem;">No bookings found.</div>
                @endforelse

                @if(isset($bookings) && count($bookings))
                <div class="final-total">
                        <span class="total-title">Total:</span>
                        <span class="total-value">₱ {{ number_format($bookings->sum('total_amount'), 2) }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer>
        <img src="assets/images/azure_logo2.png" alt="Azure Haven Logo" class="footer-logo">
        <p>Copyright © 2025 Azure Haven. All Rights Reserved.</p>
        <div class="social-icons">
            <a href="#" aria-label="Facebook">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
            </a>
            <a href="#" aria-label="Instagram">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.231 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.884a1.144 1.144 0 1 0 0 2.288 1.144 1.144 0 0 0 0-2.288zM8 4.405a3.595 3.595 0 1 0 0 7.19 3.595 3.595 0 0 0 0-7.19zm0 1.441a2.155 2.155 0 1 1 0 4.31 2.155 2.155 0 0 1 0-4.31z"/></svg>
            </a>
            <a href="#" aria-label="Twitter">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/></svg>
                </a>
        </div>
    </footer>

    <script src="script.js"></script>
  
</body>
</html>