<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="theme-color" content="#ffffff">

        <title>{{ config('app.name', 'TreCMS') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        @volt('navigation')
        <nav class="py-5 mb-10">
            <div class="container mx-auto px-5 lg:max-w-screen">
                <div class="flex items-center flex-col lg:flex-row">
                    <a href="/" class="flex items-center no-underline text-brand text-3xl font-black" wire:navigate>{{ config('app.name', 'TreCMS') }}</a>
                    <div class="lg:ml-auto mt-10 lg:mt-0 flex items-center gap-2">
                    </div>
                </div>
            </div>
            </div>
        </nav>
        @endvolt

        <!-- Page Content -->
        <div class="container mx-auto px-5 lg:max-w-screen-sm mt-20">
            {{ $slot }}
        </div>
    </body>
</html>
