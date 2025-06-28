<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azure Haven</title>
    <link rel="stylesheet" href="{{ asset('Admin/bookings.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Manuale:700,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css" integrity="sha512-t7Few9xlddEmgd3oKZQahkNI4dS6l80+eGEzFQiqtyVYdvcSG2D3Iub77R20BdotfRPA9caaRkg1tyaJiPmO0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <div class="booking-panel">
                <div class="booking-dashboard">
                    <span class="bd-title">Bookings</span>
                    <div class="bt-panel">
                        <div class="search-wrapper">
                            <img src="{{ asset('Admin/assets/search_icon.png') }}" alt="">
                            <input type="text" placeholder="Search">
                        </div>
                        
                        <div class="br-panel">
                            <div class="br-button">
                                <button class="sort-btn">
                                    <i class="fa-solid fa-sort"></i> 
                                    <span>Sort</span>
                                </button>
                            
                                <button class="filter-btn">
                                    <i class="fa-solid fa-filter"></i> 
                                    <span>Filter</span>
                                </button>

                                <a href="{{ route('add-booking') }}" class="add-btn" style="text-decoration: none; color: white;">
                                    <i class="fa-solid fa-plus"></i>
                                    <span>Add Booking</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-panel">
                        <table id="bookings-page">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Room Type</th>
                                    <th>Services</th>
                                    <th>Guest Name</th>
                                    <th>Status</th>
                                    <th>Total Amount</th>
                                    <th>Check-In</th>
                                    <th>Check-Out</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->booking_id }}</td>
                                        <td>{{ $booking->room->room_type ?? 'N/A' }}</td>
                                        <td>{{ $booking->services->pluck('service_name')->implode(', ') }}</td>
                                        <td>{{ $booking->guest->first_name ?? 'N/A' }} <br> {{ $booking->guest->last_name ?? '' }}</td>
                                        <td>{{ $booking->booking_status }}</td>
                                        <td>{{ $booking->total_amount }}</td>
                                        <td>{{ $booking->check_in_date }}</td>
                                        <td>{{ $booking->check_out_date }}</td>
                                        <td class="action-cell" style="position: relative;">
                                            <button class="action-menu-btn" onclick="togglePopup(this)">
                                                <i class="fa-solid fa-ellipsis"></i>
                                            </button>
                                            <div class="action-popup" style="display: none;">
                                                <a href="{{ route('view-booking', $booking->booking_id) }}" class="popup-btn view-btn" title="Show"><i class="fa-solid fa-eye"></i></a>
                                                <a href="{{ route('edit-booking', $booking->booking_id) }}" class="popup-btn edit-btn" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <form action="{{ route('delete-booking', $booking->booking_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="popup-btn delete-btn" title="Delete"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $bookings->links('vendor.pagination.simple') !!}
                    </div>
                </div>
            </div>
        </section>

        <script>
            function togglePopup(btn) {
                // Close any other open popups
                document.querySelectorAll('.action-popup').forEach(p => p.style.display = 'none');
                // Toggle this one
                const popup = btn.nextElementSibling;
                popup.style.display = (popup.style.display === 'flex') ? 'none' : 'flex';
            }
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.action-cell')) {
                    document.querySelectorAll('.action-popup').forEach(p => p.style.display = 'none');
                }
            });
        </script>
    </body>
</html>