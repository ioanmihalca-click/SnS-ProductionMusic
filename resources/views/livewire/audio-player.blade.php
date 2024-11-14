<div class="relative" 
     x-data="{ 
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
            <h2 class="text-2xl font-bold text-white"
                x-data="{ words: ['Listen', 'Preview', 'Experience'], currentWord: 0 }"
                x-init="setInterval(() => currentWord = (currentWord + 1) % words.length, 2000)">
                <span class="block mb-2 text-sm font-normal tracking-wider text-red-500 uppercase"
                      x-text="words[currentWord]"
                      x-transition:enter="transition ease-out duration-300"
                      x-transition:enter-start="opacity-0 transform translate-y-4"
                      x-transition:enter-end="opacity-100 transform translate-y-0">
                </span>
                Featured Tracks
            </h2>
            <p class="mt-2 text-gray-400">Select a track below to preview</p>
        </div>

       <div class="relative"
             x-data="audioPlayer({{ json_encode($tracks) }})"
             x-init="init()">
            <!-- Track List -->
            <div class="max-w-md p-4 mx-auto border rounded-lg bg-white/5 border-white/10">
                <template x-for="(track, index) in tracks" :key="index">
                    <div class="flex items-center justify-between px-3 py-2 transition-all duration-300 rounded-lg cursor-pointer hover:bg-white/5"
                         :class="{ 'bg-red-500/20': currentTrack === index && isPlaying }"
                         @click="playTrack(index)">
                        
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-red-500/20">
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                     class="w-4 h-4 text-red-500"
                                     :class="{ 'animate-pulse': currentTrack === index && isPlaying }"
                                     fill="none" 
                                     viewBox="0 0 24 24" 
                                     stroke="currentColor">
                                    <path stroke-linecap="round" 
                                          stroke-linejoin="round" 
                                          stroke-width="2" 
                                          :d="currentTrack === index && isPlaying 
                                              ? 'M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z'
                                              : 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3'" />
                                </svg>
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
     class="fixed bottom-0 left-0 right-0 z-50 bg-[#0f172a]/95 border-gray-800">
    
    <!-- Desktop Layout -->
    <div class="relative hidden h-32 md:block">
        <div class="container h-full mx-auto">
            <div class="flex items-center h-full px-4">
                <!-- Left: Track Info & Controls -->
                <div class="flex items-center space-x-4 w-[300px]">
                    <img :src="tracks[currentTrack]?.artwork || '/placeholder-image.jpg'" 
                         :alt="tracks[currentTrack]?.name"
                         class="object-cover w-10 h-10 rounded">
                    
                    <div class="flex flex-col min-w-0">
                        <span class="text-sm font-medium text-white truncate" x-text="tracks[currentTrack]?.name"></span>
                        <span class="text-xs text-gray-400 truncate" x-text="tracks[currentTrack]?.artist"></span>
                    </div>

                    <div class="flex items-center space-x-2">
                        <button @click="playPrevious()" class="text-gray-400 hover:text-white">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        
                        <button @click="togglePlay()" class="text-white">
                            <template x-if="!isPlaying">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                </svg>
                            </template>
                            <template x-if="isPlaying">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M10 9v6m4-6v6" />
                                </svg>
                            </template>
                        </button>

                        <button @click="playNext()" class="text-gray-400 hover:text-white">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Center: Waveform -->
                <div class="relative flex items-center flex-1 h-full px-4">
                    <span class="w-12 text-xs text-right text-gray-400" x-text="currentTime"></span>
                    <div class="flex-1 mx-4">
                        <div class="absolute inset-0 flex items-center px-4">
                            <div x-ref="waveform" class="w-full h-8"></div>
                        </div>
                    </div>
                    <span class="w-12 text-xs text-gray-400" x-text="tracks[currentTrack]?.duration"></span>
                </div>

                <!-- Right Controls -->
                <div class="flex items-center space-x-3 w-[200px] justify-end">
                    <!-- Volume Control -->
                    <div class="relative" @mouseleave="showVolume = false">
                        <button @mouseenter="showVolume = true" class="p-2 text-gray-400 hover:text-white">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M15.536 8.464a5 5 0 010 7.072M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </button>
                        <div x-show="showVolume" 
                             class="absolute p-2 mb-2 -translate-x-1/2 bg-gray-800 rounded-lg shadow-lg bottom-full left-1/2">
                            <input type="range" 
                                   x-model="volume" 
                                   @input="updateVolume()"
                                   class="w-24"
                                   min="0" 
                                   max="100">
                        </div>
                    </div>

                    <!-- Share Button -->
                    <button class="p-2 text-gray-400 hover:text-white">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                    </button>

                    <!-- Download Button -->
                    <button class="p-2 text-gray-400 hover:text-white">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Layout -->
    <div class="relative md:hidden h-14">
        <div class="flex items-center justify-between h-full px-4">
            <!-- Track Info -->
            <div class="flex items-center space-x-3">
                <img :src="tracks[currentTrack]?.artwork" 
                     class="object-cover w-8 h-8 rounded">
                <div class="flex flex-col">
                    <span class="text-sm font-medium text-white truncate" x-text="tracks[currentTrack]?.name"></span>
                    <span class="text-xs text-gray-400 truncate" x-text="tracks[currentTrack]?.artist"></span>
                </div>
            </div>
            
            <!-- Play Button -->
            <button @click="togglePlay()" class="text-white">
                <template x-if="!isPlaying">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                    </svg>
                </template>
                <template x-if="isPlaying">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M10 9v6m4-6v6" />
                    </svg>
                </template>
            </button>
        </div>
        
        <!-- Mobile Waveform -->
        <div class="absolute bottom-0 left-0 right-0 h-6">
            <div x-ref="waveformMobile" class="w-full h-full"></div>
        </div>
    </div>
</div>