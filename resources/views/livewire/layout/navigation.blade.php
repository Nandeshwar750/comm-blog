<?php
use function Livewire\Volt\{state, mount};

state([
    'darkMode' => false,
    'name' => '',
    'email' => '',
]);

mount(function () {
    $this->darkMode = session('darkMode', false);
    if (auth()->check()) {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
    }
});

$toggleDarkMode = function () {
    $this->darkMode = !$this->darkMode;
    session(['darkMode' => $this->darkMode]);
    $this->dispatch('dark-mode-toggled');
};

$logout = function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    return $this->redirect('/');
};
?>

<header x-data="{ 
    mobileMenuOpen: false,
    darkMode: false
}" x-init="
    darkMode = localStorage.theme === 'dark' || (!localStorage.theme && window.matchMedia('(prefers-color-scheme: dark)').matches);
    $watch('darkMode', value => {
        document.documentElement.classList.toggle('dark', value);
        localStorage.theme = value ? 'dark' : 'light';
    })
"
    class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-50 transition-colors duration-300">

    <nav class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <!-- Main navigation bar -->
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center">
                <x-application-logo class="h-8 w-auto" />
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden sm:flex items-center space-x-6">
                <!-- Search Bar -->
                {{-- <form action="{{ route('search') }}" method="GET" class="relative">
                    <input type="text" name="query" placeholder="Search..."
                        class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400">
                    <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form> --}}
                <livewire:navigation-search />

                <!-- Navigation Links -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('about') }}"
                        class="text-gray-800 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400">
                        {{ __('About') }}
                    </a>
                    <a href="{{ route('contact') }}"
                        class="text-gray-800 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400">
                        {{ __('Contact') }}
                    </a>
                </div>

                @auth
                    <!-- User Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                    x-on:profile-updated.window="name = $event.detail.name"></div>
                                <svg class="ms-1 fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile')" wire:navigate>{{ __('Profile') }}</x-dropdown-link>
                            <button wire:click="logout" class="w-full text-start">
                                <x-dropdown-link>{{ __('Log Out') }}</x-dropdown-link>
                            </button>
                        </x-slot>
                    </x-dropdown>
                @endauth

                <!-- Dark Mode Toggle -->
                <button @click="darkMode = !darkMode"
                    class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                    <svg x-show="!darkMode" class="w-6 h-6 text-gray-800 dark:text-gray-200" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg x-show="darkMode" class="w-6 h-6 text-gray-800 dark:text-gray-200" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="sm:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': mobileMenuOpen, 'inline-flex': !mobileMenuOpen }" class="inline-flex"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !mobileMenuOpen, 'inline-flex': mobileMenuOpen }" class="hidden"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }" class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <!-- Mobile Search -->
                <form action="{{ route('search') }}" method="GET" class="px-4 pb-4">
                    <div class="relative">
                        <input type="text" name="query" placeholder="Search..."
                            class="w-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400">
                        <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>

                @auth
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                @endauth

                <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
                    {{ __('About') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                    {{ __('Contact') }}
                </x-responsive-nav-link>
            </div>

            @auth
                <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800 dark:text-gray-200" x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                            x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                        <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-responsive-nav-link>
                        <button wire:click="logout" class="w-full text-start">
                            <x-responsive-nav-link>
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </button>
                    </div>
                </div>
            @endauth
        </div>
    </nav>
</header>
<script>
    // Initialize dark mode on page load
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
            '(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    function toggleDarkMode() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark')
            localStorage.theme = 'light'
        } else {
            document.documentElement.classList.add('dark')
            localStorage.theme = 'dark'
        }
    }

    // Make it globally available if needed
    window.toggleDarkMode = toggleDarkMode;
</script>

