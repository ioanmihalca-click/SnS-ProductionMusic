<!-- resources/views/library.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library - Snow N Stuff Production Music</title>
    
    <!-- Aceleași meta tags și CSS/JS imports ca în welcome.blade.php -->
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
        <!-- Header/Navigation -->
        <header class="sticky top-0 z-50 border-b backdrop-blur-xl bg-black/50 border-gray-800/50">
            <div class="container px-4 mx-auto">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo -->
                    <a href="/" class="flex items-center space-x-2">
                        <img src="{{ asset('assets/hero-production-music.webp') }}" alt="Logo" class="w-8 h-8">
                        <span class="text-lg font-bold text-white">Snow N Stuff</span>
                    </a>

                    <!-- Search Bar -->
                    <div class="flex-1 max-w-xl mx-4">
                        <div class="relative">
                            <input 
                                type="text" 
                                x-model="searchQuery"
                                placeholder="Search tracks..."
                                class="w-full px-4 py-2 text-gray-300 placeholder-gray-500 transition-colors duration-300 border rounded-lg bg-white/5 border-gray-800/50 focus:outline-none focus:border-red-500"
                            >
                            <button class="absolute p-2 -translate-y-1/2 right-2 top-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Right Actions -->
                    <div class="flex items-center space-x-4">
                        <button 
                            @click="showFilters = !showFilters"
                            class="px-4 py-2 text-sm font-medium text-gray-300 transition-all duration-300 border rounded-lg border-gray-800/50 hover:border-red-500/50 hover:text-white"
                        >
                            <span class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                class="p-2 transition-colors duration-200 rounded-lg hover:text-red-500"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </button>
                            <button 
                                @click="view = 'list'"
                                :class="{'bg-red-500/20 text-red-500': view === 'list'}"
                                class="p-2 transition-colors duration-200 rounded-lg hover:text-red-500"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Filters Panel -->
        <div 
            x-show="showFilters"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="relative z-40 border-b shadow-xl bg-black/95 border-gray-800/50 backdrop-blur-xl"
        >
            <div class="container px-4 py-6 mx-auto">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-4">
                    <!-- Genres -->
                    <div>
                        <h3 class="mb-3 text-sm font-medium text-gray-400">Genres</h3>
                        <div class="space-y-2">
                            <template x-for="genre in genres" :key="genre">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input 
                                        type="checkbox" 
                                        :value="genre"
                                        x-model="selectedGenres"
                                        class="text-red-500 border-gray-700 rounded-sm focus:ring-red-500 focus:ring-offset-gray-900"
                                    >
                                    <span class="text-sm text-gray-300" x-text="genre"></span>
                                </label>
                            </template>
                        </div>
                    </div>

                    <!-- Moods -->
                    <div>
                        <h3 class="mb-3 text-sm font-medium text-gray-400">Moods</h3>
                        <div class="space-y-2">
                            <template x-for="mood in moods" :key="mood">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input 
                                        type="checkbox" 
                                        :value="mood"
                                        x-model="selectedMoods"
                                        class="text-red-500 border-gray-700 rounded-sm focus:ring-red-500 focus:ring-offset-gray-900"
                                    >
                                    <span class="text-sm text-gray-300" x-text="mood"></span>
                                </label>
                            </template>
                        </div>
                    </div>

                    <!-- Duration -->
                    <div>
                        <h3 class="mb-3 text-sm font-medium text-gray-400">Duration (seconds)</h3>
                        <div class="space-y-2">
                            <template x-for="duration in durations" :key="duration">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input 
                                        type="checkbox" 
                                        :value="duration"
                                        x-model="selectedDurations"
                                        class="text-red-500 border-gray-700 rounded-sm focus:ring-red-500 focus:ring-offset-gray-900"
                                    >
                                    <span class="text-sm text-gray-300" x-text="duration"></span>
                                </label>
                            </template>
                        </div>
                    </div>

                    <!-- Sort & Clear -->
                    <div>
                        <h3 class="mb-3 text-sm font-medium text-gray-400">Sort By</h3>
                        <select 
                            x-model="sortBy"
                            class="w-full px-3 py-2 text-sm text-gray-300 border rounded-lg bg-white/5 border-gray-800/50 focus:outline-none focus:border-red-500"
                        >
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="name">Name (A-Z)</option>
                            <option value="duration">Duration</option>
                        </select>

                        <button 
                            @click="selectedGenres = []; selectedMoods = []; selectedDurations = []; searchQuery = ''"
                            class="w-full px-4 py-2 mt-4 text-sm text-gray-300 transition-colors duration-300 border rounded-lg border-gray-800/50 hover:border-red-500 hover:text-white"
                        >
                            Clear All Filters
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="container px-4 py-8 mx-auto">
            <!-- Stats Bar -->
            <div class="flex items-center justify-between p-4 mb-8 border rounded-lg bg-black/20 border-gray-800/50">
                <div class="text-sm text-gray-400">
                    Showing <span class="font-medium text-white">247</span> tracks
                </div>
                <div class="flex items-center space-x-2 text-sm text-gray-400">
                    <span>Active filters:</span>
                    <template x-for="genre in selectedGenres" :key="genre">
                        <span class="px-2 py-1 text-xs text-white rounded-full bg-red-500/20" x-text="genre"></span>
                    </template>
                </div>
            </div>

            <!-- Grid View -->
            <div x-show="view === 'grid'" class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <template x-for="i in 9" :key="i">
                    <div class="relative p-4 transition-all duration-300 border rounded-lg group border-gray-800/50 hover:border-red-500/50 bg-black/20">
                        <!-- Track Image -->
                        <div class="relative overflow-hidden rounded-lg aspect-video">
                            <img src="https://picsum.photos/400/225" class="object-cover w-full transition-transform duration-300 group-hover:scale-110">
                            <div class="absolute inset-0 transition-opacity duration-300 bg-gradient-to-t from-black/80 via-black/20 to-transparent group-hover:opacity-0"></div>
                            <button class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 transition-transform duration-300 text-white/80 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Track Info -->
                        <div class="mt-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-medium text-white">Epic Cinematic Theme</h3>
                                <span class="text-sm text-gray-400">2:45</span>
                            </div>
                          
                            <div class="mt-1 text-sm text-gray-400">
                                <span class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                    </svg>
                                    <span>Dramatic Orchestra</span>
                                </span>
                            </div>

                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 mt-3">
                                <span class="px-2 py-1 text-xs text-white rounded-full bg-red-500/20">Epic</span>
                                <span class="px-2 py-1 text-xs text-white rounded-full bg-red-500/20">Cinematic</span>
                                <span class="px-2 py-1 text-xs text-white rounded-full bg-red-500/20">Orchestral</span>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between mt-4">
                                <div class="flex -space-x-2">
                                    <button class="p-2 text-gray-400 transition-colors duration-200 rounded-lg hover:text-white hover:bg-gray-800/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                    <button class="p-2 text-gray-400 transition-colors duration-200 rounded-lg hover:text-white hover:bg-gray-800/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                        </svg>
                                    </button>
                                    <button class="p-2 text-gray-400 transition-colors duration-200 rounded-lg hover:text-white hover:bg-gray-800/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>
                                
                                <button class="px-4 py-2 text-sm font-medium text-white transition-all duration-300 bg-red-600 rounded-lg hover:bg-red-700">
                                    License
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- List View -->
            <div x-show="view === 'list'" class="space-y-4">
                <template x-for="i in 9" :key="i">
                    <div class="relative flex items-center p-4 transition-all duration-300 border rounded-lg group border-gray-800/50 hover:border-red-500/50 bg-black/20">
                        <!-- Track Thumbnail -->
                        <div class="relative flex-shrink-0 w-24 h-24 overflow-hidden rounded-lg">
                            <img src="https://picsum.photos/96/96" class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110">
                            <div class="absolute inset-0 transition-opacity duration-300 bg-black/30 group-hover:opacity-0"></div>
                            <button class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 transition-transform duration-300 text-white/80 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Track Info -->
                        <div class="flex-1 min-w-0 ml-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-medium text-white truncate">Epic Cinematic Theme</h3>
                                <span class="ml-4 text-sm text-gray-400">2:45</span>
                            </div>
                            
                            <div class="mt-1 text-sm text-gray-400">
                                <span class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                    </svg>
                                    <span>Dramatic Orchestra</span>
                                </span>
                            </div>

                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 mt-2">
                                <span class="px-2 py-1 text-xs text-white rounded-full bg-red-500/20">Epic</span>
                                <span class="px-2 py-1 text-xs text-white rounded-full bg-red-500/20">Cinematic</span>
                                <span class="px-2 py-1 text-xs text-white rounded-full bg-red-500/20">Orchestral</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center ml-4 space-x-2">
                            <button class="p-2 text-gray-400 transition-colors duration-200 rounded-lg hover:text-white hover:bg-gray-800/50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                            <button class="p-2 text-gray-400 transition-colors duration-200 rounded-lg hover:text-white hover:bg-gray-800/50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                            </button>
                            <button class="px-4 py-2 text-sm font-medium text-white transition-all duration-300 bg-red-600 rounded-lg hover:bg-red-700">
                                License
                            </button>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-8">
                <button class="px-4 py-2 text-sm text-gray-400 transition-colors duration-300 border rounded-lg border-gray-800/50 hover:border-red-500 hover:text-white">
                    Previous
                </button>
                <div class="flex items-center space-x-2">
                    <button class="px-4 py-2 text-sm text-white transition-all duration-300 bg-red-600 rounded-lg hover:bg-red-700">1</button>
                    <button class="px-4 py-2 text-sm text-gray-400 transition-colors duration-300 border rounded-lg border-gray-800/50 hover:border-red-500 hover:text-white">2</button>
                    <button class="px-4 py-2 text-sm text-gray-400 transition-colors duration-300 border rounded-lg border-gray-800/50 hover:border-red-500 hover:text-white">3</button>
                    <span class="text-gray-400">...</span>
                    <button class="px-4 py-2 text-sm text-gray-400 transition-colors duration-300 border rounded-lg border-gray-800/50 hover:border-red-500 hover:text-white">12</button>
                </div>
                <button class="px-4 py-2 text-sm text-gray-400 transition-colors duration-300 border rounded-lg border-gray-800/50 hover:border-red-500 hover:text-white">
                    Next
                </button>
            </div>
        </main>

        <!-- Include existing footer -->
        {{-- <x-footer /> --}}
    </div>

    @livewireScripts
</body>
</html>