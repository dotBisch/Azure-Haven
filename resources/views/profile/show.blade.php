<link rel="stylesheet" href="{{ url('about.css') }}">

    <header class="main-header">
        <div class="header-container">
            <a href="{{ url('home') }}" class="logo">
                <img src="/assets/images/azure_logo.png" alt="Azure Haven Logo">
            </a>
            <nav>
                <h2 class="update-profile-information">Update Your Profile Information</h2>
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

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
