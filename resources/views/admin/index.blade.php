<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azure Haven</title>
    <link rel="stylesheet" href="{{ asset('Admin/summary.css') }}">
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
                        <li class="nav-link link-4">
                            <a href="{{ route('staffs') }}">
                                <i class="fa-solid fa-headset"></i>
                                <span class="nav-text">Manage Staffs</span>
                            </a>
                        </li>
                        <li class="nav-link link-5">
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

        <section class="summary">
            <div class="summary-panel">
                <div class="main-summary">
                    <span class="summary-title">Summary</span>
                    <div class="counter-wrapper">
                        <div class="total-booking">
                            <span class="tb-title">Total Bookings</span>
                            <h2 class="tb-value">{{ number_format($totalBookings) }}</h2>
                        </div>
                        <div class="check-in">
                            <span class="ci-title">Check-In</span>
                            <h2 class="ci-value">{{ number_format($checkInCount) }}</h2>
                        </div>
                        <div class="check-out">
                            <span class="co-title">Check-Out</span>
                            <h2 class="co-value">{{ number_format($checkOutCount) }}</h2>
                        </div>
                    </div>

                    <div class="summary-row" style="display: flex; gap: 20px; margin-bottom: 5px;">
                        <!-- Room Summary -->
                        <div class="summary-box" style="flex: 1; background: var(--background); border-radius: 15px; box-shadow: 0px 3px 5px var(--shadow-1); padding: 24px;">
                            <span class="summary-box-title" style="font-weight: bold; color: var(--blue); font-size: 18px;">Room Summary</span>
                            <div class="summary-box-content" style="margin-top: 16px;">
                                <div>Total Rooms: <b>{{ $totalRooms }}</b></div>
                                <div>Available: <span style="color: #28a745;"><b>{{ $availableRooms }}</b></span></div>
                                <div>Occupied: <span style="color: #007bff;"><b>{{ $occupiedRooms }}</b></span></div>
                                <div>Maintenance: <span style="color: #ffc107;"><b>{{ $maintenanceRooms }}</b></span></div>
                            </div>
                        </div>
                        <!-- Service Summary -->
                        <div class="summary-box" style="flex: 1; background: var(--background); border-radius: 15px; box-shadow: 0px 3px 5px var(--shadow-1); padding: 24px;">
                            <span class="summary-box-title" style="font-weight: bold; color: var(--blue); font-size: 18px;">Service Summary</span>
                            <div class="summary-box-content" style="margin-top: 16px;">
                                <div>Total Services: <b>{{ $totalServices }}</b></div>
                                <div style="margin-top: 10px;">Top Service:</div>
                                @if($topService)
                                    <div>
                                        {{ $topService->service_name }}
                                        <span style="color: var(--blue);">₱{{ number_format($topService->service_price, 2) }}</span>
                                    </div>
                                @else
                                    <div>No services found.</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="bottom-panel">
                        <div class="revenue-overview">
                            <span class="ro-title">Revenue Overview</span>
                            <div class="total-revenue">
                                <span class="tr-title">Total Revenue</span>
                                <span class="tr-value">Php {{ number_format($totalRevenue, 2) }}</span>
                            </div>
                            <div class="tr-report">
                                <div class="tr-increase">
                                    <i class="bi bi-graph-up-arrow"></i>
                                    <span class="tri-value">Php {{ number_format($revenue30, 2) }}</span>
                                    <span class="tri-days">Last 30 Days</span>
                                </div>
                                <span class="tr-divider"></span>
                                <div class="tr-decrease">
                                    <i class="bi bi-graph-down-arrow"></i>
                                    <span class="trd-value">Php {{ number_format($revenue7, 2) }}</span>
                                    <span class="trd-days">Last 7 Days</span>
                                </div>
                            </div>
                        </div>

                        <div class="recent-arrival">
                            <div class="ra-top">
                                <span class="ra-title">Recent Arrivals</span>
                                <a href="#">
                                    <span class="view">View All</span>
                                </a>
                            </div>

                            <table id="recent-arrival">
                                <thead>
                                    <tr>
                                        <th>R. No.</th>
                                        <th>Name</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentArrivals as $arrival)
                                        <tr>
                                            <td>{{ $arrival->room->room_number ?? '-' }}</td>
                                            <td>{{ $arrival->guest->first_name ?? '' }} {{ $arrival->guest->last_name ?? '' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($arrival->updated_at)->diffForHumans() }}</td>
                                            <td>
                                                <a href="{{ route('view-booking', $arrival->booking_id) }}" class="popup-btn view-btn" title="Show"><i class="fa-solid fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if($recentArrivals->isEmpty())
                                        <tr>
                                            <td colspan="4" style="text-align:center;">No recent arrivals.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="side-summary">
                    <div class="search">
                        <div class="search-wrapper">
                            <img src="{{ asset('Admin/assets/search_icon.png') }}" alt="">
                            <input type="text" placeholder="Search">
                        </div>
                    </div>
                    
                    <div class="notif">
                        <span class="notif-title">Notifications</span>
                        <div class="notif-card-wrapper">
                            @foreach($notifications as $notif)
                                <div class="notif-card">
                                    <div class="room-details">
                                        <span class="room-number">Room {{ $notif->room->room_number ?? '-' }}</span>
                                        <span class="room-status">{{ ucfirst(str_replace('_', ' ', $notif->booking_status)) }}</span>
                                    </div>
                                    <span class="status-time">{{ \Carbon\Carbon::parse($notif->updated_at)->diffForHumans() }}</span>
                                </div>
                            @endforeach
                            @if($notifications->isEmpty())
                                <div class="notif-card" style="text-align:center;">No notifications.</div>
                            @endif
                        </div>

                        <div class="receptionist-wrapper">
                            <span class="receptionist-title">Receptionists</span>
                            <div class="receptionist-list">
                                @foreach($receptionists as $receptionist)
                                    <div class="receptionist">
                                        <span class="receptionist-image">
                                            <i class="fa-solid fa-circle-user"></i>
                                        </span>
                                        <span class="receptionist-name">{{ $receptionist->first_name }} {{ $receptionist->last_name }}</span>
                                    </div>
                                @endforeach
                                @if($receptionists->isEmpty())
                                    <div class="receptionist" style="text-align:center;">No receptionists found.</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>