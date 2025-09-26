<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Élan') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Alpine.js (needed for dropdowns, mobile menu, etc.) -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
        <x-banner />

        {{-- ✅ Conditional Navbar --}}
        @hasSection('custom-navbar')
            @yield('custom-navbar')
        @else
            @livewire('navigation-menu')
        @endif

        <!-- Page Content -->
        

        @stack('modals')

        @livewireScripts
    </body>
</html>