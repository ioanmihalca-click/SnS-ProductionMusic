<div class="relative" x-data="{
    showPersistentPlayer: false,
    currentTrack: null,
    progress: 0,
    currentTime: '0:00',
    isPlaying: false,
    volume: 80,
    showVolume: false
}">

    <div class="max-w-md mx-auto mt-4">
        <!-- Title Section -->
        <div class="mb-6 text-center font-roboto-condensed">
            <h2 class="text-2xl font-bold text-white" x-data="{ words: ['Listen', 'Preview', 'Experience'], currentWord: 0 }" x-init="setInterval(() => currentWord = (currentWord + 1) % words.length, 2000)">
                <span class="block mb-2 text-sm font-normal tracking-wider text-red-500 uppercase"
                    x-text="words[currentWord]" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0">
                </span>
                Featured Tracks
            </h2>
            <p class="mt-2 text-gray-400">Select a track below to preview</p>
        </div>

        <div class="relative" x-data="audioPlayer({{ json_encode($tracks) }})" x-init="init()">

            <!-- Track List -->
            <div class="max-w-md p-4 mx-auto border rounded-lg bg-white/5 border-white/10">
                <template x-for="(track, index) in tracks" :key="index">
                    <div class="flex items-center justify-between px-3 py-2 transition-all duration-300 rounded-lg cursor-pointer hover:bg-white/5"
                        :class="{ 'bg-red-500/20': currentTrack === index && isPlaying }" @click="playTrack(index)">

                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-red-500/20">
                                <!-- Iconița pentru Track în Redare -->
                                <template x-if="currentTrack === index && isPlaying">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-500 animate-pulse"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 5.25v13.5m-7.5-13.5v13.5" />
                                    </svg>
                                </template>

                                <!-- Iconița pentru Track Oprit/Neselectat -->
                                <template x-if="!(currentTrack === index && isPlaying)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-500" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                                    </svg>
                                </template>
                            </div>
                            <span class="text-white" x-text="track.name"></span>
                        </div>
                        <span class="px-4 text-sm text-gray-400" x-text="track.duration"></span>
                    </div>
                </template>
            </div>

         <!-- Persistent Player Modal -->
<div x-show="currentTrack !== null" 
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-full"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-full"
    class="fixed bottom-0 left-0 right-0 z-50 border-t shadow-2xl bg-gray-900/80 border-gray-800/50">

    <!-- Glowing accent line -->
    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-red-500/50 to-transparent"></div>

    <!-- Close Button -->
    <button @click="currentTrack = null; wavesurfer?.pause()"
        class="absolute top-0 right-0 p-2 text-gray-400 transition-all duration-300 -translate-y-full rounded-t-lg bg-gray-900/95 hover:bg-red-600 hover:text-white group">
        <span class="absolute px-2 py-1 text-xs transition-opacity duration-300 -translate-y-1/2 bg-gray-900 rounded-md shadow-lg opacity-0 group-hover:opacity-100 right-10 top-1/2 whitespace-nowrap backdrop-blur-sm">
            Close Player (ESC)
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M19.5 5.25l-7.5 7.5-7.5-7.5m15 6l-7.5 7.5-7.5-7.5" />
        </svg>
    </button>

    <div class="container px-4 py-3 mx-auto">
        <div class="flex flex-col space-y-4">
            <!-- Top Section: Track Info and Controls -->
            <div class="flex items-center justify-between">
                <!-- Left: Track Info -->
                <div class="flex items-center flex-1 space-x-4">
                    <div class="relative flex-shrink-0 w-12 h-12 overflow-hidden rounded-lg group">
                        <img :src="tracks[currentTrack]?.artwork || '/placeholder-image.jpg'"
                            :alt="tracks[currentTrack]?.name" 
                            class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 transition-opacity duration-300 bg-black/20 group-hover:opacity-0"></div>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="text-sm font-medium text-white truncate transition-colors duration-200 hover:text-red-500"
                            x-text="tracks[currentTrack]?.name"></span>
                        <span class="text-xs text-gray-400 truncate transition-colors duration-200 hover:text-gray-300"
                            x-text="tracks[currentTrack]?.artist || 'Unknown Artist'"></span>
                    </div>
                </div>

                <!-- Right: Volume & Actions -->
                <div class="flex items-center justify-end flex-1 space-x-6">
                    <!-- Volume Control -->
                    <div class="relative" @mouseleave="showVolume = false">
                        <button @mouseenter="showVolume = true"
                            class="p-2 text-gray-400 transition-all duration-200 rounded-full hover:text-white hover:bg-gray-800/50">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                            </svg>
                        </button>

                        <div x-show="showVolume" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute p-3 -translate-x-1/2 border rounded-lg shadow-xl bg-gray-800/95 bottom-full left-1/2 backdrop-blur-sm border-gray-700/50">
                            <div class="h-24">
                                <input type="range" x-model="volume" @input="updateVolume()"
                                    class="vertical-slider" orient="vertical" min="0" max="100">
                            </div>
                        </div>
                    </div>

                    <!-- Share Button -->
                    <button class="hidden p-2 text-gray-400 transition-all duration-200 rounded-full md:block hover:text-white hover:bg-gray-800/50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                        </svg>
                    </button>

                    <!-- Menu Button -->
                    <button class="hidden p-2 text-gray-400 transition-all duration-200 rounded-full md:block hover:text-white hover:bg-gray-800/50">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                        </svg>
                    </button>

                    <!-- License Button -->
                    <button class="px-4 py-2 text-sm font-medium text-white transition-all duration-300 bg-red-600 rounded-lg hover:bg-red-700 hover:shadow-lg hover:shadow-red-600/20">
                        License
                    </button>
                </div>
            </div>

            <!-- Middle Section: Waveform -->
            <div class="relative">
                <div x-ref="waveform" @click="seekTo($event)"
                    class="w-full h-24 transition-all duration-300 rounded-lg cursor-pointer hover:opacity-90 ">
                    <!-- Loading indicator -->
                    <div x-show="loading"
                        class="absolute inset-0 z-10 flex items-center justify-center rounded-lg bg-black/30 backdrop-blur-sm">
                        <div class="w-8 h-8 border-4 border-red-500 rounded-full border-t-transparent animate-spin">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-2 space-x-4">
                    <!-- Time and Controls Container -->
                    <div class="flex items-center flex-1 space-x-4">
                        <!-- Current Time -->
                        <span class="text-xs font-medium text-gray-400 min-w-[40px]" x-text="currentTime"></span>

                        <!-- Playback Controls -->
                        <div class="flex items-center justify-center flex-1">
                            <div class="flex items-center space-x-8">
                                <button @click="playPrevious()"
                                    class="p-2 text-gray-400 transition-all duration-200 rounded-full hover:text-white hover:bg-gray-800/50"
                                    :class="{ 'opacity-50 cursor-not-allowed': currentTrack === 0 }"
                                    :disabled="currentTrack === 0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 19.5 8.25 12l7.5-7.5" />
                                    </svg>
                                </button>

                                <button @click="togglePlay()"
                                    class="p-3 text-white transition-all duration-300 transform bg-red-600 rounded-full hover:scale-110 hover:bg-red-700 hover:shadow-lg hover:shadow-red-600/20">
                                    <template x-if="!isPlaying">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                                        </svg>
                                    </template>
                                    <template x-if="isPlaying">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 5.25v13.5m-7.5-13.5v13.5" />
                                        </svg>
                                    </template>
                                </button>

                                <button @click="playNext()"
                                    class="p-2 text-gray-400 transition-all duration-200 rounded-full hover:text-white hover:bg-gray-800/50"
                                    :class="{ 'opacity-50 cursor-not-allowed': currentTrack === tracks.length - 1 }"
                                    :disabled="currentTrack === tracks.length - 1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Duration -->
                        <span class="text-xs font-medium text-gray-400 min-w-[40px] text-right" 
                            x-text="tracks[currentTrack]?.duration"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

              
