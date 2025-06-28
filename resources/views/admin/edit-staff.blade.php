@php $staff = $staff ?? null; @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azure Haven - Edit Staff</title>
    <link rel="stylesheet" href="{{ asset('Admin/staffs.css') }}">
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

        .form-input, .form-select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
            font-family: 'Manuale', serif;
            background-color: #fff;
            color: #333;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .form-select:focus {
            outline: none;
            border-color: var(--blue);
            background-color: #f0f8ff;
        }

        .form-select option {
            color: #333;
            background: #fff;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .password-requirements {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
            border-left: 4px solid var(--blue);
        }

        .password-requirements h4 {
            margin: 0 0 10px 0;
            color: var(--blue);
            font-size: 14px;
        }

        .password-requirements ul {
            margin: 0;
            padding-left: 20px;
            font-size: 12px;
            color: #666;
        }

        .password-requirements li {
            margin-bottom: 5px;
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

        .staff-info {
            background-color: #e3f2fd;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid var(--blue);
        }

        .staff-info h4 {
            margin: 0 0 10px 0;
            color: var(--blue);
        }

        .staff-info p {
            margin: 0;
            font-size: 14px;
            color: #666;
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

        /* Active navigation states */
        .link-4 {
            background-color: var(--background);
            box-shadow: 0px 3px 5px var(--shadow-1);
        }

        .link-5 {
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
                    <li class="nav-link link-1">
                        <a href="{{ route('dashboard') }}">
                            <i class="fa-solid fa-chart-pie"></i>
                            <span class="nav-text">Summary</span>
                        </a>
                    </li>
                    <li class="nav-link link-2">
                        <a href="{{ route('bookings') }}">
                            <i class="fa-solid fa-book-open"></i>
                            <span class="nav-text">Bookings</span>
                        </a>
                    </li>
                    <li class="nav-link link-3">
                        <a href="{{ route('rooms') }}">
                            <i class="fa-solid fa-door-closed"></i>
                            <span class="nav-text">Manage Rooms</span>
                        </a>
                    </li>
                    <li class="nav-link {{ request('back') === 'staffs' ? 'link-4' : '' }}">
                        <a href="{{ route('staffs') }}">
                            <i class="fa-solid fa-headset"></i>
                            <span class="nav-text">Manage Staffs</span>
                        </a>
                    </li>
                    <li class="nav-link {{ request('back') === 'guests' ? 'link-5' : '' }}">
                        <a href="{{ route('guests') }}">
                            <i class="fa-solid fa-users"></i>
                            <span class="nav-text">Manage Guests</span>
                        </a>
                    </li>
                    <li class="nav-link link-6">
                        <a href="{{ route('services') }}">
                            <i class="fa-solid fa-clipboard-list"></i>
                            <span class="nav-text">Services</span>
                        </a>
                    </li>
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
    <section class="staff">
        <div class="form-container">
            <h2 class="form-title">Edit Staff</h2>
            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('update-staff', $staff->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-input" value="{{ old('first_name', $staff->first_name) }}" required>
                        @error('first_name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-input" value="{{ old('last_name', $staff->last_name) }}" required>
                        @error('last_name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-input" value="{{ old('email', $staff->email) }}" required>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-input" value="{{ old('phone', $staff->phone) }}">
                        @error('phone')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="usertype" class="form-label">User Type</label>
                        <select name="usertype" id="usertype" class="form-select" required>
                            <option value="admin" selected>Admin</option>
                        </select>
                        @error('usertype')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Update Staff
                    </button>
                    <a href="{{ route('staffs') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Back to Staffs
                    </a>
                </div>
            </form>
        </div>
    </section>
</body>
</html> 