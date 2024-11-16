<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Snow N Stuff Production Music' }}</title>

    <!-- Favicons -->
    <link rel="icon" href="{{ asset('assets/favicon/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/favicon/favicon.svg') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png') }}">
    <meta name="apple-mobile-web-app-title" content="SnS">
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest') }}">

    <meta name="description"
        content="Your ultimate source for exclusive, emotion-driven production music. Professional music library for TV, film, and advertising.">
    <meta property="og:title" content="Snow N Stuff Production Music">
    <meta property="og:description" content="Your ultimate source for exclusive, emotion-driven production music.">
    <meta property="og:image" content="{{ asset('assets/og-image.jpg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="min-h-screen bg-gradient-to-b from-black via-gray-900 to-black">
 
        <!-- Conținutul principal -->
        {{ $slot }}

        <!-- Footer -->
        <x-footer />

        @livewireScripts
</body>

</html>
