<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azure Haven - Edit Room</title>
    <link rel="stylesheet" href="{{ asset('Admin/rooms.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Manuale:700,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
            font-family: 'Manuale', serif;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--blue);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
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

        .room-type-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }

        .room-type-option {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .room-type-option:hover {
            border-color: var(--blue);
            background-color: #f8f9fa;
        }

        .room-type-option input[type="radio"] {
            margin-right: 10px;
            transform: scale(1.2);
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .room-type-options {
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

                    {{-- Summary: admin only --}}
                    @if(auth()->user()->usertype === 'admin')
                    <li class="nav-link link-1">
                        <a href="{{ route('dashboard') }}">
                            <i class="fa-solid fa-chart-pie"></i>
                            <span class="nav-text">Summary</span>
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
    <section class="room">
        <div class="form-container">
            <h2 class="form-title">Edit Room</h2>
            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('update-room', $room->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group">
                        <label for="room_number" class="form-label">Room Number</label>
                        <input type="text" name="room_number" id="room_number" class="form-input" value="{{ old('room_number', $room->room_number) }}" required>
                        @error('room_number')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="room_type" class="form-label">Room Type</label>
                        <input type="text" name="room_type" id="room_type" class="form-input" value="{{ old('room_type', $room->room_type) }}" required>
                        @error('room_type')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="room_price" class="form-label">Room Price</label>
                        <input type="number" name="room_price" id="room_price" class="form-input" value="{{ old('room_price', $room->room_price) }}" required min="0">
                        @error('room_price')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="room_pax" class="form-label">Room Pax</label>
                        <input type="number" name="room_pax" id="room_pax" class="form-input" value="{{ old('room_pax', $room->room_pax) }}" required min="1">
                        @error('room_pax')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="room_description" class="form-label">Room Description</label>
                        <textarea name="room_description" id="room_description" class="form-textarea" required>{{ old('room_description', $room->room_description) }}</textarea>
                        @error('room_description')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="room_status" class="form-label">Room Status</label>
                        <select name="room_status" id="room_status" class="form-select" required>
                            <option value="available" {{ $room->room_status == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="occupied" {{ $room->room_status == 'occupied' ? 'selected' : '' }}>Occupied</option>
                            <option value="maintenance" {{ $room->room_status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                        @error('room_status')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="room_features" class="form-label">Room Features</label>
                        <input type="text" name="room_features" id="room_features" class="form-input" value="{{ old('room_features', $room->room_features) }}">
                        @error('room_features')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="room_inclusions" class="form-label">Room Inclusions</label>
                        <input type="text" name="room_inclusions" id="room_inclusions" class="form-input" value="{{ old('room_inclusions', $room->room_inclusions) }}">
                        @error('room_inclusions')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="room_image" class="form-label">Room Image</label>
                        <input type="text" name="room_image" id="room_image" class="form-input" value="{{ old('room_image', $room->room_image) }}">
                        @error('room_image')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Update Room
                    </button>
                    <a href="{{ route('rooms') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Back to Rooms
                    </a>
                </div>
            </form>
        </div>
    </section>
</body>
</html> 