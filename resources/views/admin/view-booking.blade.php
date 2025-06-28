<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azure Haven - View Booking</title>
    <link rel="stylesheet" href="{{ asset('Admin/bookings.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Manuale:700,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css" integrity="sha512-t7Few9xlddEmgd3oKZQahkNI4dS6l80+eGEzFQiqtyVYdvcSG2D3Iub77R20BdotfRPA9caaRkg1tyaJiPmO0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .form-container {
            background-color: var(--background);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 3px 5px var(--shadow-1);
            margin: 20px;
            max-width: 800px;
            width: 100%;
        }

        .form-title {
            font-size: 24px;
            font-weight: bold;
            color: var(--blue);
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }

        .form-input, .form-select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Manuale', serif;
            background-color: #f8f9fa;
            color: #333;
            cursor: not-allowed;
        }

        .form-input:disabled, .form-select:disabled {
            opacity: 0.8;
            background-color: #f8f9fa;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .services-section {
            margin-top: 20px;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 10px;
        }

        .service-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
            background-color: #f8f9fa;
            opacity: 0.8;
        }

        .service-info {
            flex: 1;
        }

        .service-name {
            font-weight: 600;
            color: #333;
        }

        .service-price {
            font-size: 12px;
            color: var(--blue);
            font-weight: 600;
        }

        .price-breakdown {
            margin-top: 20px;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #e9ecef;
        }

        .breakdown-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 15px;
        }

        .breakdown-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #dee2e6;
        }

        .breakdown-item:last-child {
            border-bottom: none;
        }

        .breakdown-label {
            font-weight: 600;
            color: #495057;
        }

        .breakdown-value {
            font-weight: 600;
            color: var(--blue);
        }

        .breakdown-item.total {
            border-top: 2px solid var(--blue);
            border-bottom: none;
            padding-top: 15px;
            margin-top: 10px;
        }

        .breakdown-item.total .breakdown-label {
            font-size: 18px;
            color: var(--blue);
        }

        .breakdown-item.total .breakdown-value {
            font-size: 18px;
            color: var(--blue);
        }

        .booking-status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-confirmed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .form-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background-color: var(--blue);
            color: white;
        }

        .btn-primary:hover {
            background-color: #3a6b8a;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .services-grid {
                grid-template-columns: 1fr;
            }
            
            .form-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <nav class="sidebar">
        <header>
            <div class="user">
                <div class="user-wrapper">
                    <span class="user-image">
                        <i class="fa-solid fa-circle-user"></i>
                    </span>
                    <div class="user-details">
                        <span class="user-name">{{ Auth::user()->first_name ?? 'USER NAME' }}</span>
                        <span class="user-admin">{{ ucfirst(Auth::user()->usertype ?? 'Admin') }}</span>
                    </div>
                </div>
            </div>

            <div class="logout-responsive">
                <a href="#">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            </div>
        </header>

        <div class="nav-list">
            <div class="nav-list-wrapper">
                <span class="nav-title">Dashboards</span>
                <ul class="nav-wrapper">
                    {{-- Bookings: visible to all admin/receptionist --}}
                    @if(auth()->user()->usertype === 'admin' || auth()->user()->usertype === 'receptionist')
                    <li class="nav-link link-2">
                        <a href="{{ route('bookings') }}">
                            <i class="fa-solid fa-book-open"></i>
                            <span class="nav-text">Bookings</span>
                        </a>
                    </li>
                    @endif

                    {{-- Guests: visible to all admin/receptionist --}}
                    @if(auth()->user()->usertype === 'admin' || auth()->user()->usertype === 'receptionist')
                    <li class="nav-link link-5">
                        <a href="{{ route('guests') }}">
                            <i class="fa-solid fa-users"></i>
                            <span class="nav-text">Manage Guests</span>
                        </a>
                    </li>
                    @endif

                    {{-- Rooms: admin only --}}
                    @if(auth()->user()->usertype === 'admin')
                    <li class="nav-link link-3">
                        <a href="{{ route('rooms') }}">
                            <i class="fa-solid fa-door-closed"></i>
                            <span class="nav-text">Manage Rooms</span>
                        </a>
                    </li>
                    @endif

                    {{-- Staffs: admin only --}}
                    @if(auth()->user()->usertype === 'admin')
                    <li class="nav-link link-4">
                        <a href="{{ route('staffs') }}">
                            <i class="fa-solid fa-headset"></i>
                            <span class="nav-text">Manage Staffs</span>
                        </a>
                    </li>
                    @endif

                    {{-- Services: admin only --}}
                    @if(auth()->user()->usertype === 'admin')
                    <li class="nav-link link-6">
                        <a href="{{ route('services') }}">
                            <i class="fa-solid fa-clipboard-list"></i>
                            <span class="nav-text">Services</span>
                        </a>
                    </li>
                    @endif
                </ul>

                <div class="logout">
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; padding: 0; color: inherit; cursor: pointer;">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>

            <span class="hotel-logo">
                <img src="{{ asset('Admin/assets/AzureHaven_Logo.png') }}" alt="Azure Haven Logo">
            </span>
        </div>
    </nav>

    <section class="booking">
        <div class="form-container">
            <h2 class="form-title">View Booking Details</h2>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Booking ID</label>
                    <input type="text" value="{{ $booking->booking_id }}" class="form-input" disabled>
                </div>

                <div class="form-group">
                    <label class="form-label">Booking Status</label>
                    <div>
                        <span class="booking-status status-{{ $booking->booking_status }}">
                            {{ ucfirst($booking->booking_status) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Room</label>
                    <input type="text" value="{{ $booking->room->room_number ?? 'N/A' }} - {{ $booking->room->room_type ?? 'N/A' }}" class="form-input" disabled>
                </div>

                <div class="form-group">
                    <label class="form-label">Guest</label>
                    <input type="text" value="{{ $booking->guest->first_name ?? 'N/A' }} {{ $booking->guest->last_name ?? '' }}" class="form-input" disabled>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Check-in Date</label>
                    <input type="text" value="{{ $booking->check_in_date }}" class="form-input" disabled>
                </div>

                <div class="form-group">
                    <label class="form-label">Check-out Date</label>
                    <input type="text" value="{{ $booking->check_out_date }}" class="form-input" disabled>
                </div>
            </div>

            <div class="services-section">
                <label class="form-label">Additional Services</label>
                <div class="services-grid">
                    @if($booking->services->count() > 0)
                        @foreach($booking->services as $service)
                            <div class="service-item">
                                <div class="service-info">
                                    <div class="service-name">{{ $service->service_name }}</div>
                                    <div class="service-price">₱{{ number_format($service->service_price, 2) }}</div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="service-item">
                            <div class="service-info">
                                <div class="service-name">No additional services</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="price-breakdown">
                <label class="form-label">Price Breakdown</label>
                <div class="breakdown-container">
                    <div class="breakdown-item">
                        <span class="breakdown-label">Room Price per Night:</span>
                        <span class="breakdown-value">₱{{ number_format($booking->room->room_price ?? 0, 2) }}</span>
                    </div>
                    <div class="breakdown-item">
                        <span class="breakdown-label">Number of Nights:</span>
                        <span class="breakdown-value">
                            @php
                                $checkIn = new DateTime($booking->check_in_date);
                                $checkOut = new DateTime($booking->check_out_date);
                                $nights = $checkIn->diff($checkOut)->days;
                            @endphp
                            {{ $nights }}
                        </span>
                    </div>
                    <div class="breakdown-item">
                        <span class="breakdown-label">Room Total:</span>
                        <span class="breakdown-value">₱{{ number_format(($booking->room->room_price ?? 0) * $nights, 2) }}</span>
                    </div>
                    <div class="breakdown-item">
                        <span class="breakdown-label">Services Total:</span>
                        <span class="breakdown-value">₱{{ number_format($booking->services->sum('service_price'), 2) }}</span>
                    </div>
                    <div class="breakdown-item total">
                        <span class="breakdown-label">Total Amount:</span>
                        <span class="breakdown-value">₱{{ number_format($booking->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="form-buttons">
                <a href="{{ route('bookings') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Back to Bookings
                </a>
            </div>
        </div>
    </section>
</body>
</html> 