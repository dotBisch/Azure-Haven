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
                            <h2 class="tb-value">10, 215</h2>
                        </div>
                        <div class="check-in">
                            <span class="ci-title">Check-In</span>
                            <h2 class="ci-value">201</h2>
                        </div>
                        <div class="check-out">
                            <span class="co-title">Check-Out</span>
                            <h2 class="co-value">450</h2>
                        </div>
                    </div>

                    <div class="chart">
                        <div class="chart-wrapper"></div>
                    </div>

                    <div class="bottom-panel">
                        <div class="revenue-overview">
                            <span class="ro-title">Revenue Overview</span>
                            <div class="total-revenue">
                                <span class="tr-title">Total Revenue</span>
                                <span class="tr-value">Php 1, 255, 615</span>
                            </div>
                            <div class="tr-report">
                                <div class="tr-increase">
                                    <i class="bi bi-graph-up-arrow"></i>
                                    <span class="tri-value">Php 105, 517</span>
                                    <span class="tri-days">Last 30 Days</span>
                                </div>
                                <span class="tr-divider"></span>
                                <div class="tr-decrease">
                                    <i class="bi bi-graph-down-arrow"></i>
                                    <span class="trd-value">Php 21, 112</span>
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
                                    <tr>
                                        <td >401</td>
                                        <td>Juan Dela Cruz</td>
                                        <td>1 seconds ago</td>
                                        <td>...</td>
                                    </tr>
                                    <tr>
                                        <td >402</td>
                                        <td>Pancho Pablete</td>
                                        <td>1 minute ago</td>
                                        <td>...</td>
                                    </tr>
                                    <tr>
                                        <td >403</td>
                                        <td>Mary Pops</td>
                                        <td>1 minute ago</td>
                                        <td>...</td>
                                    </tr>
                                    <tr>
                                        <td >404</td>
                                        <td>David Salon</td>
                                        <td>6 minute ago</td>
                                        <td>...</td>
                                    </tr>
                                    <tr>
                                        <td >405</td>
                                        <td>Harry Potter</td>
                                        <td>1 hour ago</td>
                                        <td>...</td>
                                    </tr>
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
                            <div class="notif-card">
                                <div class="room-details">
                                    <span class="room-number">Room 301</span>
                                    <span class="room-status">Checked In</span>
                                </div>
                                <span class="status-time">Just Now</span>
                            </div>
                            <div class="notif-card">
                                <div class="room-details">
                                    <span class="room-number">Room 301</span>
                                    <span class="room-status">Checked In</span>
                                </div>
                                <span class="status-time">Just Now</span>
                            </div>
                            <div class="notif-card">
                                <div class="room-details">
                                    <span class="room-number">Room 301</span>
                                    <span class="room-status">Checked In</span>
                                </div>
                                <span class="status-time">Just Now</span>
                            </div>
                        </div>

                        <div class="receptionist-wrapper">
                            <span class="receptionist-title">Receptionists</span>
                                <div class="receptionist-list">
                                    <div class="receptionist">
                                        <span class="receptionist-image">
                                            <i class="fa-solid fa-circle-user"></i>
                                        </span>
                                        <span class="receptionist-name">Natali Craig</span>
                                    </div>
                                    <div class="receptionist">
                                        <span class="receptionist-image">
                                            <i class="fa-solid fa-circle-user"></i>
                                        </span>
                                        <span class="receptionist-name">Natali Craig</span>
                                    </div>
                                    <div class="receptionist">
                                        <span class="receptionist-image">
                                            <i class="fa-solid fa-circle-user"></i>
                                        </span>
                                        <span class="receptionist-name">Kate Morrison</span>
                                    </div>
                                    <div class="receptionist">
                                        <span class="receptionist-image">
                                            <i class="fa-solid fa-circle-user"></i>
                                        </span>
                                        <span class="receptionist-name">Drew Cano</span>
                                    </div>
                                    <div class="receptionist">
                                        <span class="receptionist-image">
                                            <i class="fa-solid fa-circle-user"></i>
                                        </span>
                                        <span class="receptionist-name">Andi Lane</span>
                                    </div>
                                    <div class="receptionist">
                                        <span class="receptionist-image">
                                            <i class="fa-solid fa-circle-user"></i>
                                        </span>
                                        <span class="receptionist-name">Melody Macy</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>