@props(['title' => 'Laravel'])

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css', 'resources/js/app.js')
    <title>{{ $title }}</title>
  </head>
  <body class="bg-gray-50">

    <main>
        {{ $slot }}
    </main>

    <x-footer />

  </body>
</html>
