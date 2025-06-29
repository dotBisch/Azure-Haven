<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azure Haven - Add Service</title>
    <link rel="icon" href="{{ asset('Admin/assets/AzureHaven_Logo_2.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('Admin/services.css') }}">
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

        .form-input, .form-textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
            font-family: 'Manuale', serif;
            background-color: #fff;
            color: #333;
        }

        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--blue);
            background-color: #f0f8ff;
        }

        .form-textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Manuale', serif;
            min-height: 100px;
            resize: vertical;
            background-color: #fff;
            color: #333;
        }

        .form-textarea:focus {
            outline: none;
            border-color: var(--blue);
            background-color: #f0f8ff;
        }

        .form-label[for="service_description"] {
            color: var(--blue);
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .service-info {
            background-color: #e3f2fd;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid var(--blue);
        }

        .service-info h4 {
            margin: 0 0 10px 0;
            color: var(--blue);
        }

        .service-info p {
            margin: 0;
            font-size: 14px;
            color: #666;
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

        .service-examples {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
            border-left: 4px solid var(--green);
        }

        .service-examples h4 {
            margin: 0 0 10px 0;
            color: var(--green);
            font-size: 14px;
        }

        .service-examples ul {
            margin: 0;
            padding-left: 20px;
            font-size: 12px;
            color: #666;
        }

        .service-examples li {
            margin-bottom: 5px;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .form-buttons {
                flex-direction: column;
            }
        }

        /* Active navigation states */
        .link-6 {
            background-color: var(--background);
            box-shadow: 0px 3px 5px var(--shadow-1);
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

    <section class="service">
        <div class="form-container">
            <h2 class="form-title">Add New Service</h2>

            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <div class="service-info">
                <h4><i class="fa-solid fa-info-circle"></i> Service Information</h4>
                <p>Services are additional amenities that guests can add to their bookings. These can include spa treatments, transportation, dining services, and more.</p>
            </div>

            <form action="{{ route('store-service') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="service_name" class="form-label">Service Name</label>
                    <input type="text" name="service_name" id="service_name" class="form-input" required placeholder="e.g., Spa Massage, Airport Transfer, Room Service">
                    @error('service_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    
                    <div class="service-examples">
                        <h4><i class="fa-solid fa-lightbulb"></i> Service Examples</h4>
                        <ul>
                            <li>Spa & Wellness: Massage, Facial, Sauna</li>
                            <li>Transportation: Airport Transfer, Car Rental, Shuttle</li>
                            <li>Dining: Room Service, Restaurant Reservation, Catering</li>
                            <li>Activities: Tour Guide, Water Sports, Fitness Classes</li>
                        </ul>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="service_price" class="form-label">Service Price (₱)</label>
                        <input type="number" name="service_price" id="service_price" class="form-input" required min="0" step="0.01" placeholder="0.00">
                        @error('service_price')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="service_pax" class="form-label">Maximum Capacity</label>
                        <input type="number" name="service_pax" id="service_pax" class="form-input" required min="1" max="50" placeholder="1-50">
                        @error('service_pax')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="service_description" class="form-label">Service Description</label>
                    <textarea name="service_description" id="service_description" class="form-textarea" required placeholder="Describe the service, what's included, duration, and any special requirements..."></textarea>
                    @error('service_description')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i> Add Service
                    </button>
                    <a href="{{ route('services') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Back to Services
                    </a>
                </div>
            </form>
        </div>
    </section>

    <script>
        // Auto-format service name input
        document.getElementById('service_name').addEventListener('input', function() {
            this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
        });

        // Auto-format price input
        document.getElementById('service_price').addEventListener('input', function() {
            if (this.value < 0) {
                this.value = 0;
            }
        });

        // Auto-format pax input
        document.getElementById('service_pax').addEventListener('input', function() {
            if (this.value < 1) {
                this.value = 1;
            } else if (this.value > 50) {
                this.value = 50;
            }
        });
    </script>
</body>
</html> 