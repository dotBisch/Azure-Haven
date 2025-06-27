<header class="main-header">
    <div class="header-container">
        <a href="#" class="logo">
            <img src="/assets/images/azure_logo.png" alt="Azure Haven Logo">
        </a>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}" class="active">Home</a></li>
                <li><a href="{{ route('aboutUs') }}">About Us</a></li>
                <li><a href="{{ route('roomsAndServices') }}">Rooms & Services</a></li>
                <li><a href="{{ route('contactUs') }}">Contact Us</a></li>
            </ul>
        </nav>
        
        @if (Route::has('login'))
            @auth
                <x-app-layout>

                </x-app-layout>
            @else
                <a href="{{ url('login') }}" class="btn-book-now">Book Now</a>

            @endauth
        @endif
    </div>
</header>