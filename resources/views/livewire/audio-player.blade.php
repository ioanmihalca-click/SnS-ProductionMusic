<div class="max-w-md p-4 mx-auto border rounded-lg bg-white/5 border-white/10"
     x-data="{ 
        audioElement: new Audio(),
        initAudio() {
            this.audioElement.addEventListener('ended', () => {
                @this.isPlaying = false;
            });
        }
     }"
     x-init="initAudio()"
     @playAudio.window="
        audioElement.src = $event.detail.track.file;
        audioElement.play();
     "
     @pauseAudio.window="audioElement.pause()">
    
    @foreach($tracks as $index => $track)
        <div class="flex items-center justify-between px-3 py-2 transition-all duration-300 rounded-lg"
             :class="{ 'bg-red-500/20': {{ $currentTrack }} === {{ $index }} && {{ $isPlaying }} }"
             wire:click="playTrack({{ $index }})">
            
            <div class="flex items-center space-x-3">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-red-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="w-4 h-4 text-red-500"
                         :class="{ 'animate-pulse': {{ $currentTrack }} === {{ $index }} && {{ $isPlaying }} }"
                         fill="none" 
                         viewBox="0 0 24 24" 
                         stroke="currentColor">
                        @if($currentTrack === $index && $isPlaying)
                            <path stroke-linecap="round" 
                                  stroke-linejoin="round" 
                                  stroke-width="2" 
                                  d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        @else
                            <path stroke-linecap="round" 
                                  stroke-linejoin="round" 
                                  stroke-width="2" 
                                  d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                        @endif
                    </svg>
                </div>
                <span class="text-white">{{ $track['name'] }}</span>
            </div>
            <span class="text-sm text-gray-400">{{ $track['duration'] }}</span>
        </div>
    @endforeach

    <!-- Circular Audio Visualizer -->
    <div class="absolute transform -translate-x-1/2 -translate-y-1/2 pointer-events-none top-1/2 left-1/2"
         x-data="{ circles: Array(5).fill() }"
         :class="{ 'scale-110': {{ $isPlaying }}, 'scale-100': !{{ $isPlaying }} }"
         style="transition: transform 0.5s ease-out">
        <template x-for="(circle, index) in circles" :key="index">
            <div class="absolute border rounded-full border-red-500/30"
                :style="`width: ${(index + 1) * 100}px; height: ${(index + 1) * 100}px; 
                        animation: pulse ${2 + index * 0.5}s infinite ease-out;
                        animation-delay: ${index * 0.2}s`"></div>
        </template>
    </div>
</div>

