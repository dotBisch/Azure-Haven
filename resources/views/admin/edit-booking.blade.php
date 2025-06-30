<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azure Haven - Edit Booking</title>
    <link rel="icon" href="{{ asset('Admin/assets/AzureHaven_Logo_2.png') }}" type="image/png">
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
            transition: border-color 0.3s ease;
            font-family: 'Manuale', serif;
        }

        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: var(--blue);
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
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .service-item:hover {
            border-color: var(--blue);
            background-color: #f8f9fa;
        }

        .service-item input[type="checkbox"] {
            margin-right: 10px;
            transform: scale(1.2);
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

        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
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

        .status-checked_in {
            background-color: #cce5ff;
            color: #004085;
        }

        .status-checked_out {
            background-color: #e2e3e5;
            color: #383d41;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
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

                    {{-- Summary: admin only --}}
                    @if(auth()->user()->usertype === 'admin')
                    <li class="nav-link link-1">
                        <a href="{{ route('dashboard') }}">
                            <i class="fa-solid fa-chart-pie"></i>
                            <span class="nav-text">Summary</span>
                        </a>
                    </li>
                    @endif

                    {{-- Bookings: visible to all admin/receptionist --}}
                    @if(auth()->user()->usertype === 'admin' || auth()->user()->usertype === 'receptionist')
                    <li class="nav-link link-2">
                        <a href="{{ route('bookings') }}">
                            <i class="fa-solid fa-book-open"></i>
                            <span class="nav-text">Bookings</span>
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

                    {{-- Guests: visible to all admin/receptionist --}}
                    @if(auth()->user()->usertype === 'admin' || auth()->user()->usertype === 'receptionist')
                    <li class="nav-link link-5">
                        <a href="{{ route('guests') }}">
                            <i class="fa-solid fa-users"></i>
                            <span class="nav-text">Manage Guests</span>
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
            <h2 class="form-title">Edit Booking</h2>

            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('update-booking', $booking->booking_id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="room_id" class="form-label">Room</label>
                        <select name="room_id" id="room_id" class="form-select" required>
                            <option value="">Select a room</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}" data-price="{{ $room->room_price }}" {{ $booking->room_id == $room->id ? 'selected' : '' }}>
                                    {{ $room->room_number }} - {{ $room->room_type }} (₱{{ number_format($room->room_price, 2) }})
                                </option>
                            @endforeach
                        </select>
                        @error('room_id')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="booking_status" class="form-label">Booking Status</label>
                        <select name="booking_status" id="booking_status" class="form-select" required>
                            <option value="pending" {{ $booking->booking_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $booking->booking_status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="checked_in" {{ $booking->booking_status == 'checked_in' ? 'selected' : '' }}>Checked In</option>
                            <option value="checked_out" {{ $booking->booking_status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                            <option value="cancelled" {{ $booking->booking_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('booking_status')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="user_id" class="form-label">Guest</label>
                        <select name="user_id" id="user_id" class="form-select" required>
                            <option value="">Select a guest</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $booking->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->first_name }} {{ $user->last_name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="check_in_date" class="form-label">Check-in Date</label>
                        <input type="date" name="check_in_date" id="check_in_date" class="form-input" required value="{{ $booking->check_in_date }}" min="{{ date('Y-m-d') }}">
                        @error('check_in_date')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="check_out_date" class="form-label">Check-out Date</label>
                        <input type="date" name="check_out_date" id="check_out_date" class="form-input" required value="{{ $booking->check_out_date }}">
                        @error('check_out_date')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="services-section">
                    <label class="form-label">Additional Services (Optional)</label>
                    <div class="services-grid">
                        @foreach($services as $service)
                            <div class="service-item">
                                <input type="checkbox" name="services[]" id="service_{{ $service->id }}" value="{{ $service->id }}" data-price="{{ $service->service_price }}" {{ $booking->services->contains($service->id) ? 'checked' : '' }}>
                                <div class="service-info">
                                    <div class="service-name">{{ $service->service_name }}</div>
                                    <div class="service-price">₱{{ number_format($service->service_price, 2) }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="price-breakdown">
                    <label class="form-label">Price Breakdown</label>
                    <div class="breakdown-container">
                        <div class="breakdown-item">
                            <span class="breakdown-label">Room Price per Night:</span>
                            <span class="breakdown-value" id="room-price-per-night">₱0.00</span>
                        </div>
                        <div class="breakdown-item">
                            <span class="breakdown-label">Number of Nights:</span>
                            <span class="breakdown-value" id="number-of-nights">0</span>
                        </div>
                        <div class="breakdown-item">
                            <span class="breakdown-label">Room Total:</span>
                            <span class="breakdown-value" id="room-total">₱0.00</span>
                        </div>
                        <div class="breakdown-item">
                            <span class="breakdown-label">Services Total:</span>
                            <span class="breakdown-value" id="services-total">₱0.00</span>
                        </div>
                        <div class="breakdown-item total">
                            <span class="breakdown-label">Total Amount:</span>
                            <span class="breakdown-value" id="total-amount">₱0.00</span>
                        </div>
                    </div>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Update Booking
                    </button>
                    <a href="{{ route('bookings') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Back to Bookings
                    </a>
                </div>
            </form>
        </div>
    </section>

    <script>
        // Set minimum check-out date based on check-in date
        document.getElementById('check_in_date').addEventListener('change', function() {
            const checkInDate = this.value;
            const checkOutInput = document.getElementById('check_out_date');
            if (checkInDate) {
                const nextDay = new Date(checkInDate);
                nextDay.setDate(nextDay.getDate() + 1);
                checkOutInput.min = nextDay.toISOString().split('T')[0];
                if (checkOutInput.value && checkOutInput.value <= checkInDate) {
                    checkOutInput.value = '';
                }
            }
        });

        // Calculate total amount when room or services change
        function calculateTotal() {
            const roomSelect = document.getElementById('room_id');
            const checkInDate = document.getElementById('check_in_date').value;
            const checkOutDate = document.getElementById('check_out_date').value;
            
            const selectedRoom = roomSelect.options[roomSelect.selectedIndex];
            const roomPricePerNight = selectedRoom ? parseFloat(selectedRoom.dataset.price) || 0 : 0;
            
            // Calculate number of nights
            let numberOfNights = 0;
            if (checkInDate && checkOutDate) {
                const checkIn = new Date(checkInDate);
                const checkOut = new Date(checkOutDate);
                const timeDiff = checkOut.getTime() - checkIn.getTime();
                numberOfNights = Math.ceil(timeDiff / (1000 * 3600 * 24));
            }
            
            // Calculate room total
            const roomTotal = roomPricePerNight * numberOfNights;
            
            // Calculate services total
            let servicesTotal = 0;
            const selectedServices = document.querySelectorAll('input[name="services[]"]:checked');
            selectedServices.forEach(service => {
                servicesTotal += parseFloat(service.dataset.price) || 0;
            });
            
            // Calculate final total
            const total = roomTotal + servicesTotal;
            
            // Update display
            document.getElementById('room-price-per-night').textContent = '₱' + roomPricePerNight.toFixed(2);
            document.getElementById('number-of-nights').textContent = numberOfNights;
            document.getElementById('room-total').textContent = '₱' + roomTotal.toFixed(2);
            document.getElementById('services-total').textContent = '₱' + servicesTotal.toFixed(2);
            document.getElementById('total-amount').textContent = '₱' + total.toFixed(2);
            
            console.log('Total amount: ₱' + total.toFixed(2));
        }

        document.getElementById('room_id').addEventListener('change', calculateTotal);
        document.getElementById('check_in_date').addEventListener('change', calculateTotal);
        document.getElementById('check_out_date').addEventListener('change', calculateTotal);
        document.querySelectorAll('input[name="services[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', calculateTotal);
        });

        // Calculate initial total on page load
        calculateTotal();
    </script>
</body>
</html> 