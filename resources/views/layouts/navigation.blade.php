<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/logo1.png') }}" alt="" width="40px">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @if (Auth::user()->role == 'admin')
                        <x-nav-link :href="route('pos.index')" :active="request()->routeIs('pos*')">
                            {{ __('Sales') }}
                        </x-nav-link>
                        <x-nav-link :href="route('announcement.index')" :active="request()->routeIs('announcement*')">
                            {{ __('Announcements') }}
                        </x-nav-link>
                        <x-nav-link :href="route('events.index')" :active="request()->routeIs('events*')">
                            {{ __('Events') }}
                        </x-nav-link>
                       
                        <x-nav-link :href="route('inventory.index')" :active="request()->routeIs('inventory*')">
                            {{ __('Inventory') }}
                        </x-nav-link>

                        <x-nav-link :href="route('members.index')" :active="request()->routeIs('members*')">
                            {{ __('Members') }}
                        </x-nav-link>
                    @endif
                     <x-nav-link :href="route('category.index')" :active="request()->routeIs('category*')">
                            {{ __('Category') }}
                        </x-nav-link>
                    <x-nav-link :href="route('equipment.index')" :active="request()->routeIs('equipment*')">
                        {{ __('Equipment') }}
                    </x-nav-link>
                    <x-nav-link :href="route('exercise.index')" :active="request()->routeIs('exercise*')">
                        {{ __('Exercise') }}
                    </x-nav-link>
                    <x-nav-link :href="route('workout.index')" :active="request()->routeIs('workout*')">
                        {{ __('Workout') }}
                    </x-nav-link>

                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                    <x-dropdown-link :href="route('weight.index')">
                            {{ __('Weight Progress') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('calculator.index')">
                            {{ __('TDEE Calculator') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('program.index')">
                            {{ __('Programs') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @if (Auth::user()->role == 'admin')
                <x-responsive-nav-link :href="route('pos.index')" :active="request()->routeIs('pos*')">
                    {{ __('POS') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('category.index')" :active="request()->routeIs('category*')">
                    {{ __('Category') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('inventory.index')" :active="request()->routeIs('inventory*')">
                    {{ __('Inventory') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('members.index')" :active="request()->routeIs('members*')">
                    {{ __('Members') }}
                </x-responsive-nav-link>
            @endif
            <x-responsive-nav-link :href="route('equipment.index')" :active="request()->routeIs('equipment*')">
                {{ __('Equipment') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('exercise.index')" :active="request()->routeIs('exercise*')">
                {{ __('Exercise') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('workout.index')" :active="request()->routeIs('workout*')">
                {{ __('Workout') }}
            </x-responsive-nav-link>

        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
    .floating-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 60px;
        height: 60px;
        background-color: #4f46e5;
        /* Indigo */
        color: white;
        border-radius: 50%;
        text-align: center;
        line-height: 60px;
        font-size: 24px;
        font-weight: bold;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        transition: background-color 0.3s ease;
        text-decoration: none;
    }

    .floating-button:hover {
        background-color: #3730a3;
        /* Darker Indigo on hover */
    }

    .floating-button i {
        font-size: 24px;

    }
</style>

@if (Auth::user()->role == 'admin' || Auth::user()->role == 'Member')
    <a href="/scanner" class="floating-button" title="Open Camera">
        📷
    </a>
    
@endif

