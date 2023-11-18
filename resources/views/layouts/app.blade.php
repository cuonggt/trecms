<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TreCMS') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'], 'vendor/trecms/build')
    </head>
    <body class="font-sans antialiased h-full">
        <div>
            <livewire:layout.sidebar />

            <div class="lg:pl-72">
                <livewire:layout.topbar />

                <main class="mx-auto h-full w-full px-4 md:px-6 lg:px-8 max-w-7xl">
                    {{ $slot }}
                </main>
            </div>
        </div>

        <x-trecms::notifications :message="session('notify')" />
    </body>
</html>
