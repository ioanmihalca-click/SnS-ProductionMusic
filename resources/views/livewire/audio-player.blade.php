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
 <!-- Title Section - Mai subtil și elegant -->
<div class="mb-8 text-center font-roboto-condensed">
    <h2 class="text-2xl font-bold text-white/90" 
        x-data="{ words: ['Listen', 'Preview', 'Experience'], currentWord: 0 }" 
        x-init="setInterval(() => currentWord = (currentWord + 1) % words.length, 2000)">
        <span class="block mb-2 text-sm font-medium tracking-wider uppercase text-red-500/90"
              x-text="words[currentWord]"
              x-transition:enter="transition ease-out duration-300"
              x-transition:enter-start="opacity-0 transform translate-y-4"
              x-transition:enter-end="opacity-100 transform translate-y-0">
        </span>
        <span class="text-transparent bg-gradient-to-r from-white to-white/80 bg-clip-text">
            Featured Tracks
        </span>
    </h2>
    <p class="mt-2 text-gray-400/80">Select a track below to preview</p>
</div>

<!-- Track List - Design mai rafinat -->
<div class="max-w-md p-6 mx-auto border rounded-xl bg-white/[0.02] border-white/5 backdrop-blur-sm shadow-2xl">
    <template x-for="(track, index) in tracks" :key="index">
        <div class="flex items-center justify-between px-4 py-3 mb-2 transition-all duration-300 rounded-lg cursor-pointer hover:bg-white/5 group"
             :class="{ 'bg-gradient-to-r from-red-500/20 to-red-500/5': currentTrack === index && isPlaying }" 
             @click="playTrack(index)">
            <div class="flex items-center space-x-4">
                <div class="flex items-center justify-center w-10 h-10 transition-transform duration-300 rounded-full bg-red-500/10 group-hover:scale-110">
                    <template x-if="currentTrack === index && isPlaying">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             class="w-4 h-4 text-red-500 animate-pulse"
                             fill="none" viewBox="0 0 24 24" 
                             stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                  d="M15.75 5.25v13.5m-7.5-13.5v13.5" />
                        </svg>
                    </template>
                    <template x-if="!(currentTrack === index && isPlaying)">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             class="w-4 h-4 text-red-500"
                             fill="none" viewBox="0 0 24 24" 
                             stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                  d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                        </svg>
                    </template>
                </div>
                <div class="flex flex-col">
                    <span class="font-medium text-white/90 group-hover:text-white" x-text="track.name"></span>
                    <span class="text-xs text-gray-500" x-text="track.artist || 'Unknown Artist'"></span>
                </div>
            </div>
            <span class="px-4 text-sm text-gray-400/80" x-text="track.duration"></span>
        </div>
    </template>
</div>

<!-- Persistent Player - Mai elegant și modern -->
<div x-show="currentTrack !== null" 
     class="fixed bottom-0 left-0 right-0 z-50 border-t shadow-2xl backdrop-blur-md bg-gray-900/80 border-white/5">
    <div class="container px-6 py-4 mx-auto">
        <div class="flex flex-col space-y-4">
            <!-- Top Section -->
            <div class="flex items-center justify-between">
                <!-- Track Info -->
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 overflow-hidden rounded-lg shadow-lg">
                        <img :src="tracks[currentTrack]?.artwork" 
                             class="object-cover w-full h-full transition-transform duration-500 hover:scale-110">
                    </div>
                    <div class="flex flex-col">
                        <span class="text-sm font-medium text-white/90" x-text="tracks[currentTrack]?.name"></span>
                        <span class="text-xs text-gray-400/80" x-text="tracks[currentTrack]?.artist"></span>
                    </div>
                </div>

                          

                            <!-- Right: Volume & Actions -->
                            <div class="flex items-center justify-end flex-1 space-x-4">
                                <!-- Volume Control -->
                                <div class="relative" @mouseleave="showVolume = false">
                                    <button @mouseenter="showVolume = true"
                                        class="text-gray-400 transition-colors hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                        </svg>
                                    </button>
                                    <div x-show="showVolume"
                                        class="absolute p-2 mb-2 -translate-x-1/2 bg-gray-800 rounded-lg shadow-lg bottom-full left-1/2">
                                        <input type="range" x-model="volume" @input="updateVolume()"
                                            class="w-24 accent-red-500" min="0" max="100">
                                    </div>
                                </div>

                                <!-- Share Button -->
                                <button class="text-gray-400 transition-colors hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                                    </svg>
                                </button>

                                <!-- Menu Button -->
                                <button class="text-gray-400 transition-colors hover:text-white">
                                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                    </svg>
                                </button>

                                <!-- License Button -->
                                <button
                                    class="px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 transition-colors">
                                    License
                                </button>
                            </div>
                        </div>

                        <!-- Middle Section: Waveform -->
                        <div class="relative">
                            <div x-ref="waveform" @click="seekTo($event)"
                                class="w-full h-24 transition-all duration-300 rounded-lg cursor-pointer hover:opacity-90">
                                <!-- Loading indicator -->
                                <div x-show="loading"
                                    class="absolute inset-0 z-10 flex items-center justify-center rounded-lg bg-black/30">
                                    <div
                                        class="w-8 h-8 border-4 border-red-500 rounded-full border-t-transparent animate-spin">
                                    </div>
                                </div>
                            </div>

<div class="flex items-center justify-between space-x-4">
    <!-- Time and Controls Container -->
    <div class="flex items-center flex-1 space-x-4">
        <!-- Current Time -->
        <span class="text-xs text-gray-400 min-w-[40px]" x-text="currentTime"></span>

        <!-- Playback Controls -->
        <div class="flex items-center justify-center flex-1">
            <div class="flex items-center space-x-6">
                <button @click="playPrevious()"
                    class="text-gray-400 transition-colors hover:text-white"
                    :disabled="currentTrack === 0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>

                <button @click="togglePlay()"
                    class="p-2 text-white transition-all duration-200 transform rounded-full hover:scale-110 hover:text-red-500">
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
                    class="text-gray-400 transition-colors hover:text-white"
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
        <span class="text-xs text-gray-400 min-w-[40px] text-right" x-text="tracks[currentTrack]?.duration"></span>
    </div>
</div>
                        </div>
                    </div>
                </div>
            </div>
