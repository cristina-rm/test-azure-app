<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@if (trim($__env->yieldContent('template_title'))) @yield('template_title') | @endif {{ config('app.name', 'New Project') }}</title>
        <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">

        <!-- Font awesome -->
        <script src="https://kit.fontawesome.com/2d566fa444.js" crossorigin="anonymous"></script>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('css/custom.css') }}">
        <link rel="stylesheet" href="{{ mix('css/front.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

        <script>
            function showBodyScroll(value) {
                if (!value) {
                    document.querySelector('body').style.overflowY = 'hidden';
                    document.querySelector('body').style.paddingRight = '15px';
                } else {
                    document.querySelector('body').style.overflowY = 'scroll';
                }
            }
        </script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-ternary">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
