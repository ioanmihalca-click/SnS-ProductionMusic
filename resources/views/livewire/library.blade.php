<div>

    <div class="relative" x-data="{
        showFilters: false,
        searchQuery: '',
    }" @reset-filters.window="searchQuery = ''">

        <header class="sticky top-0 z-50 border-b backdrop-blur-xl bg-black/50 border-gray-800/50">
            <div class="container px-4 mx-auto">
                <!-- Header flexibil pentru mobile -->
                <div
                    class="flex flex-col gap-3 py-3 md:flex-row md:items-center md:justify-between md:py-0 md:gap-0 md:h-16">
                    <!-- Logo -->
                    <a href="/" class="flex items-center space-x-2">
                        <img src="{{ asset('assets/logo-production-music.jpg') }}" alt="Logo"
                            class="w-12 h-12 md:w-16 md:h-16">
                        {{-- <span class="text-base font-bold tracking-wide text-white md:text-lg font-roboto-condensed">Snow N Stuff</span> --}}
                    </a>

                    <!-- Search Bar - Full width pe mobile -->
                    <div class="flex-1 w-full md:max-w-xl md:mx-4">
                        <div class="relative">
                            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search tracks..."
                                class="w-full px-4 py-2 text-sm text-gray-300 placeholder-gray-500 transition-colors duration-300 border rounded-lg md:text-base bg-white/5 border-gray-800/50 focus:outline-none focus:border-red-500">
                            <button class="absolute p-2 -translate-y-1/2 right-2 top-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 md:w-5 md:h-5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>

                            <!-- Loading indicator -->
                            <div wire:loading wire:target="search" class="absolute -translate-y-1/2 right-10 top-1/2">
                                <svg class="w-4 h-4 text-red-500 animate-spin" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </div>

                            <!-- Clear button - visible when there's text -->
                            @if ($search)
                                <button wire:click="$set('search', '')"
                                    class="absolute p-1.5 text-gray-400 transition-colors duration-200 rounded-full hover:text-white hover:bg-gray-800/50 right-8 top-1/2 -translate-y-1/2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons - Flex wrap pe mobile -->
                    <div class="flex items-center gap-2 md:gap-4">
                        <button @click="showFilters = !showFilters"
                            class="flex-1 px-3 py-2 text-xs font-medium text-gray-300 transition-all duration-300 border rounded-lg md:flex-none md:px-4 md:text-sm border-gray-800/50 hover:border-red-500/50 hover:text-white">
                            <span class="flex items-center justify-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                <span>Filters</span>
                            </span>
                        </button>
                        <!-- View Toggle -->
                        <div class="flex p-1 border rounded-lg border-gray-800/50">
                            <button wire:click="$set('view', 'grid')"
                                class="p-1.5 md:p-2 text-gray-500 transition-colors duration-200 rounded-lg hover:text-red-500 {{ $view === 'grid' ? 'bg-red-500/20 text-red-500' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </button>

                            <button wire:click="$set('view', 'list')"
                                class="p-1.5 md:p-2 text-gray-500 transition-colors duration-200 rounded-lg hover:text-red-500 {{ $view === 'list' ? 'bg-red-500/20 text-red-500' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Filters Panel -->
        <div x-show="showFilters" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="relative z-40 border-b shadow-xl bg-black/95 border-gray-800/50 backdrop-blur-xl">
            <div class="container px-4 py-6 mx-auto">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-4">
                    <!-- Genres -->
                    <div>
                        <h3 class="mb-3 text-sm font-medium text-gray-400">Genres</h3>
                        <div class="space-y-2">
                            @foreach (App\Models\Genre::orderBy('name')->pluck('name') as $genre)
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" value="{{ $genre }}" wire:model.live="selectedGenres"
                                        class="text-red-500 border-gray-700 rounded-sm focus:ring-red-500 focus:ring-offset-gray-900">
                                    <span class="text-sm text-gray-300">{{ $genre }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Moods -->
                    <div>
                        <h3 class="mb-3 text-sm font-medium text-gray-400">Moods</h3>
                        <div class="space-y-2">
                            @foreach (App\Models\Mood::orderBy('name')->pluck('name') as $mood)
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" value="{{ $mood }}"
                                        wire:model.live="selectedMoods"
                                        class="text-red-500 border-gray-700 rounded-sm focus:ring-red-500 focus:ring-offset-gray-900">
                                    <span class="text-sm text-gray-300">{{ $mood }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Duration -->
                    <div>
                        <h3 class="mb-3 text-sm font-medium text-gray-400">Duration (seconds)</h3>
                        <div class="space-y-2">
                            @foreach (['0-30', '30-60', '60-120', '120+'] as $duration)
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" value="{{ $duration }}"
                                        wire:model.live="selectedDurations"
                                        class="text-red-500 border-gray-700 rounded-sm focus:ring-red-500 focus:ring-offset-gray-900">
                                    <span class="text-sm text-gray-300">{{ $duration }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Sort & Clear -->
                    <div>
                        <h3 class="mb-3 text-sm font-medium text-gray-400">Sort By</h3>
                        <select x-model="sortBy" @change="$wire.set('sortBy', sortBy)"
                            class="w-full px-3 py-2 text-sm text-gray-500 border rounded-lg bg-white/5 border-gray-800/50 focus:outline-none focus:border-red-500">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="name">Name (A-Z)</option>
                            <option value="duration">Duration</option>
                        </select>

                        <button wire:click="clearFilters"
                            class="w-full px-4 py-2 mt-4 text-sm text-gray-300 transition-colors duration-300 border rounded-lg border-gray-800/50 hover:border-red-500 hover:text-white">
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
                    Showing <span class="font-medium text-white">{{ $tracks->total() }}</span> tracks
                </div>
                <div class="flex items-center space-x-2 text-sm text-gray-400">
                    <span>Active filters:</span>
                    @foreach ($selectedGenres as $genre)
                        <span class="px-2 py-1 text-xs text-white rounded-full bg-red-500/20">
                            {{ $genre }}
                        </span>
                    @endforeach
                    @foreach ($selectedMoods as $mood)
                        <span class="px-2 py-1 text-xs text-white rounded-full bg-red-500/20">
                            {{ $mood }}
                        </span>
                    @endforeach
                    @foreach ($selectedDurations as $duration)
                        <span class="px-2 py-1 text-xs text-white rounded-full bg-red-500/20">
                            {{ $duration }}
                        </span>
                    @endforeach
                </div>
            </div>

            <!-- Grid View -->
            <div x-show="$wire.view === 'grid'" class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 md:gap-6">
                @foreach ($tracks as $track)
                    <div
                        class="relative p-3 transition-all duration-300 border rounded-lg md:p-4 group border-gray-800/50 hover:border-red-500/50 bg-black/20">
                        <!-- Track Image -->
                        <div class="relative overflow-hidden rounded-lg aspect-video">
                            <img src="{{ $track->artwork_path ? asset('storage/' . $track->artwork_path) : asset('assets/default-track-artwork.jpg') }}"
                                class="object-cover w-full transition-transform duration-300 group-hover:scale-110"
                                alt="{{ $track->name }}">
                            <div
                                class="absolute inset-0 transition-opacity duration-300 bg-gradient-to-t from-black/80 via-black/20 to-transparent group-hover:opacity-0">
                            </div>
                            <button wire:click="playTrack({{ $track->id }})"
                                class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-12 h-12 transition-transform duration-300 text-white/80 group-hover:scale-110"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Track Info -->
                        <div class="mt-3 md:mt-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-base font-medium text-white truncate md:text-lg">{{ $track->name }}
                                </h3>
                                <span
                                    class="ml-2 text-xs text-gray-400 md:text-sm">{{ gmdate('i:s', $track->duration) }}</span>
                            </div>

                            <!-- Tags -->
                            <div class="flex flex-wrap gap-1.5 md:gap-2 mt-2 md:mt-3">
                                @foreach ($track->genres as $genre)
                                    <span
                                        class="px-2 py-0.5 text-xs text-white rounded-full bg-red-500/20">{{ $genre->name }}</span>
                                @endforeach
                                @foreach ($track->moods as $mood)
                                    <span
                                        class="px-2 py-0.5 text-xs text-white rounded-full bg-red-500/20">{{ $mood->name }}</span>
                                @endforeach
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between mt-3 md:mt-4">
                                <div class="flex -space-x-1 md:-space-x-2">
                                    <button wire:click="toggleFavorite({{ $track->id }})"
                                        class="p-1.5 md:p-2 text-gray-400 transition-colors duration-200 rounded-lg hover:text-white hover:bg-gray-800/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                    <button
                                        class="p-2 text-gray-400 transition-colors duration-200 rounded-lg hover:text-white hover:bg-gray-800/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                        </svg>
                                    </button>
                                    <button
                                        class="p-2 text-gray-400 transition-colors duration-200 rounded-lg hover:text-white hover:bg-gray-800/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>

                                <button
                                    class="px-3 md:px-4 py-1.5 md:py-2 text-xs md:text-sm font-medium text-white transition-all duration-300 bg-red-600 rounded-lg hover:bg-red-700">
                                    License
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- List View -->
            <div x-show="$wire.view === 'list'" class="space-y-4">
                @foreach ($tracks as $track)
                    <div
                        class="relative flex items-center p-4 transition-all duration-300 border rounded-lg group border-gray-800/50 hover:border-red-500/50 bg-black/20">
                        <!-- Track Thumbnail -->
                        <div class="relative flex-shrink-0 w-24 h-24 overflow-hidden rounded-lg">
                            <img src="{{ $track->artwork_path ? asset('storage/' . $track->artwork_path) : asset('path/to/default-image.jpg') }}"
                                class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110"
                                alt="{{ $track->name }}">
                            <div
                                class="absolute inset-0 transition-opacity duration-300 bg-black/30 group-hover:opacity-0">
                            </div>
                            <button wire:click="playTrack({{ $track->id }})"
                                class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-8 h-8 transition-transform duration-300 text-white/80 group-hover:scale-110"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Track Info -->
                        <div class="flex-1 min-w-0 ml-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-medium text-white truncate">{{ $track->name }}</h3>

                            </div>

                            <!-- Genres and Moods -->
                            <div class="flex flex-wrap gap-2 mt-2">
                                @foreach ($track->genres as $genre)
                                    <span
                                        class="px-2 py-1 text-xs text-white rounded-full bg-red-500/20">{{ $genre->name }}</span>
                                @endforeach
                                @foreach ($track->moods as $mood)
                                    <span
                                        class="px-2 py-1 text-xs text-white rounded-full bg-red-500/20">{{ $mood->name }}</span>
                                @endforeach
                            </div>

                            <!-- BPM and Key info if available -->
                            @if ($track->bpm || $track->key)
                                <div class="flex items-center gap-4 mt-2 text-sm text-gray-400">
                                    @if ($track->bpm)
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                            </svg>
                                            {{ $track->bpm }} BPM
                                        </span>
                                    @endif
                                    @if ($track->key)
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                            </svg>
                                            Key: {{ $track->key }}
                                        </span>
                                    @endif
                                    <span
                                        class="ml-4 text-sm text-gray-400">{{ gmdate('i:s', $track->duration) }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center ml-4 space-x-2">
                            <button wire:click="toggleFavorite({{ $track->id }})"
                                class="p-2 text-gray-400 transition-colors duration-200 rounded-lg hover:text-white hover:bg-gray-800/50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>

                            <!-- License Button -->
                            <button
                                class="px-4 py-2 text-sm font-medium text-white transition-all duration-300 bg-red-600 rounded-lg hover:bg-red-700">
                                <span class="hidden md:inline">License</span>

                                </span>
                            </button>
                        </div>
                    </div>
                @endforeach

                <!-- Pagination -->
                @if ($tracks->hasPages())
                    <div class="mt-6">
                        {{ $tracks->links() }}
                    </div>
                @endif
            </div>
        </main>
    </div>

  <!-- Persistent Player -->
    <x-persistent-player />

</div>
