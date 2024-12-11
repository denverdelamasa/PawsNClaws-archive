<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PawsnClaws') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            // Apply saved theme from localStorage before the page renders
            const savedTheme = localStorage.getItem('theme') || 'light'; // Default to 'light'
            document.documentElement.setAttribute('data-theme', savedTheme);
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen  dark:">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
    <script>
        let userId = {{ Auth::user()->user_id ?? 'null' }}; // Ensure user is authenticated before accessing userId

        if (userId) {
            // Send an AJAX request when the user closes the browser or goes inactive
            window.onbeforeunload = function() {
                fetch('/user/offline', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ user_id: userId })
                });
            };

            // You can also use setInterval to check for activity and make the user offline after a certain period of inactivity
        }
    </script>


</html>
