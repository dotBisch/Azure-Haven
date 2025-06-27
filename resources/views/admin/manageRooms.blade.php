<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azure Haven</title>
    <link rel="stylesheet" href="{{ asset('Admin/rooms.css') }}">
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
                            <span class="user-name">USER NAME</span>
                            <span class="user-admin">Admin</span>
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
                    <img src="assets/AzureHaven_Logo.png" alt="Azure Haven Logo">
                </span>
            </div>
        </nav>

        <section class="room">
            <div class="room-panel">
                <div class="room-dashboard">
                    <div class="rt-panel">
                        <span class="rd-title">Rooms</span>
                        <button class="add-room-btn" style="margin-left: 20px; padding: 8px 16px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer;">Add Room</button>
                        <div class="rr-panel">
                            <div class="rr-button">
                                <button class="sort-btn">
                                    <i class="fa-solid fa-sort"></i> 
                                    <span>Sort</span>
                                </button>
                            
                                <button class="filter-btn">
                                    <i class="fa-solid fa-filter"></i> 
                                    <span>Filter</span>
                                </button>
                            </div>

                            <div class="search-wrapper">
                                <img src="assets/search_icon.png" alt="">
                                <input type="text" placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <div class="table-panel">
                        <table id="rooms-page">
                            <thead>
                                <tr>
                                    <th>Room Number</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Pax</th>
                                    <th>Features</th>
                                    <th>Inclusions</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $room)
                                    <tr>
                                        <td>{{ $room->room_number }}</td>
                                        <td>{{ $room->room_type }}</td>
                                        <td>{{ $room->room_price }}</td>
                                        <td>{{ $room->room_description }}</td>
                                        <td>{{ $room->room_pax }}</td>
                                        <td>{{ $room->room_features }}</td>
                                        <td>{{ $room->room_inclusions }}</td>
                                        <td>{{ $room->room_status }}</td>
                                        <td><button class="edit">•••</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>