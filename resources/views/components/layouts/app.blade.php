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
    <div class="relative" x-data="{
        showFilters: false,
        selectedGenres: [],
        selectedMoods: [],
        selectedDurations: [],
        searchQuery: '',
        view: 'grid', // or 'list'
        sortBy: 'newest',
        genres: ['Cinematic', 'Corporate', 'Advertising', 'Documentary', 'Epic', 'Drama'],
        moods: ['Uplifting', 'Dramatic', 'Inspiring', 'Emotional', 'Energetic', 'Suspense'],
        durations: ['0-30', '30-60', '60-120', '120+']
    }">
<header class="sticky top-0 z-50 border-b backdrop-blur-xl bg-black/50 border-gray-800/50">
    <div class="container px-4 mx-auto">
        <!-- Header flexibil pentru mobile -->
        <div class="flex flex-col gap-3 py-3 md:flex-row md:items-center md:justify-between md:py-0 md:gap-0 md:h-16">
            <!-- Logo -->
            <a href="/" class="flex items-center space-x-2">
                <img src="{{ asset('assets/logo-production-music.jpg') }}" alt="Logo" class="w-10 h-10 md:w-12 md:h-12">
                <span class="text-base font-bold tracking-wide text-white md:text-lg font-roboto-condensed">Snow N Stuff</span>
            </a>

            <!-- Search Bar - Full width pe mobile -->
            <div class="flex-1 w-full md:max-w-xl md:mx-4">
                <div class="relative">
                    <input 
                        type="text" 
                        x-model="searchQuery"
                        placeholder="Search tracks..."
                        class="w-full px-4 py-2 text-sm text-gray-300 placeholder-gray-500 transition-colors duration-300 border rounded-lg md:text-base bg-white/5 focus:outline-none focus:border-red-500"
                    >
                    <button class="absolute p-2 -translate-y-1/2 right-2 top-1/2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 md:w-5 md:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Action Buttons - Flex wrap pe mobile -->
            <div class="flex items-center gap-2 md:gap-4">
                <button 
                    @click="showFilters = !showFilters"
                    class="flex-1 px-3 py-2 text-xs font-medium text-gray-300 transition-all duration-300 border rounded-lg md:flex-none md:px-4 md:text-sm border-gray-800/50 hover:border-red-500/50 hover:text-white"
                >
                    <span class="flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        <span>Filters</span>
                    </span>
                </button>

                <!-- View Toggle -->
                <div class="flex p-1 border rounded-lg border-gray-800/50">
                    <button 
                        @click="view = 'grid'"
                        :class="{'bg-red-500/20 text-red-500': view === 'grid'}"
                        class="p-1.5 md:p-2 text-gray-500 transition-colors duration-200 rounded-lg hover:text-red-500"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                    </button>
                    
                    <button 
                        @click="view = 'list'"
                        :class="{'bg-red-500/20 text-red-500': view === 'list'}"
                        class="p-1.5 md:p-2 text-gray-500 transition-colors duration-200 rounded-lg hover:text-red-500"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
        
     <!-- Conținutul principal -->
    {{ $slot }}

    <!-- Footer -->
    <x-footer />

    @livewireScripts
</body>
</html>