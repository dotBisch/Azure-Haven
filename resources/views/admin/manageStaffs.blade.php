<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azure Haven</title>
    <link rel="stylesheet" href="{{ asset('Admin/staffs.css') }}">
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

        <section class="staff">
            <div class="staff-panel">
                <div class="staff-dashboard">
                    <span class="fd-title">Staffs</span>
                    <div class="ft-panel">
                        <div class="search-wrapper">
                            <img src="{{ asset('Admin/assets/search_icon.png') }}" alt="">
                            <input type="text" placeholder="Search">
                        </div>

                        <div class="fr-panel">
                            <div class="fr-button">
                                <button class="sort-btn">
                                    <i class="fa-solid fa-sort"></i> 
                                    <span>Sort</span>
                                </button>
                        
                                <button class="filter-btn">
                                    <i class="fa-solid fa-filter"></i> 
                                    <span>Filter</span>
                                </button>

                                <a href="{{ route('add-staff', [], false) }}?back=staffs" class="add-btn" style="text-decoration: none; color: white;">
                                    <i class="fa-solid fa-plus"></i>
                                    <span>Add Staff</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-panel">
                        <table id="staffs-page">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Usertype</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($staffs as $staff)
                                    <tr>
                                        <td>{{ $staff->id }}</td>
                                        <td>{{ $staff->first_name }}</td>
                                        <td>{{ $staff->last_name }}</td>
                                        <td>{{ $staff->email }}</td>
                                        <td>{{ $staff->phone }}</td>
                                        <td>{{ $staff->usertype }}</td>
                                        <td class="action-cell" style="position: relative;">
                                            <button class="action-menu-btn" onclick="togglePopup(this)">
                                                <i class="fa-solid fa-ellipsis"></i>
                                            </button>
                                            <div class="action-popup" style="display: none;">
                                                <a href="{{ route('view-staff', $staff->id) }}?back=staffs" class="popup-btn view-btn" title="Show"><i class="fa-solid fa-eye"></i></a>
                                                <a href="{{ route('edit-staff', $staff->id) }}" class="popup-btn edit-btn" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <button class="popup-btn delete-btn" title="Delete"><i class="fa-solid fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $staffs->links('vendor.pagination.simple') !!}
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