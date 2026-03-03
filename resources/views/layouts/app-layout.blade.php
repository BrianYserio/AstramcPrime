@props(['title' => 'Laravel'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    {{-- sidebar section via reusable sidebar --}}
    <x-sidebar id="sidebar" />

    <div id="main-content"
        class="ml-[250px] flex flex-col min-h-screen
                transition-all duration-300">
        {{-- Main content section --}}
        <main class="flex-grow p-6">
            {{ $slot }}
        </main>
        {{-- footer section via reusable footer --}}
        <x-footer />
    </div>

</body>
</html>
