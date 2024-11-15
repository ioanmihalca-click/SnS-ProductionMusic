// resources/js/audio-player.js
import WaveSurfer from 'wavesurfer.js'
import Hover from 'wavesurfer.js/dist/plugins/hover.esm.js'

document.addEventListener('alpine:init', () => {
    Alpine.data('audioPlayer', (tracks) => ({
        wavesurfer: null,
        currentTrack: null,
        isPlaying: false,
        tracks: tracks,
        progress: 0,
        currentTime: '0:00',
        volume: 80,
        showVolume: false,
        
        init() {
            this.initWaveSurfer();
            this.$watch('currentTrack', (value) => {
                if (value !== null) {
                    this.loadTrack(this.tracks[value]);
                }
            });
        },

        initWaveSurfer() {
            this.wavesurfer = WaveSurfer.create({
                container: this.$refs.waveform,
                waveColor: '#FFFFFF',
                progressColor: '#EF4444', // red-500 to match your theme
                cursorColor: '#EF4444',
                barWidth: 2,
                barGap: 1,
                barRadius: 3,
                height: 48,
                normalize: true,
                hideScrollbar: true,
                plugins: [
                    Hover.create({
                        lineColor: '#EF4444',
                        labelBackground: '#1F2937', // gray-800
                        labelColor: '#ffffff',
                    })
                ]
            });

            this.wavesurfer.on('play', () => {
                this.isPlaying = true;
            });
            
            this.wavesurfer.on('pause', () => {
                this.isPlaying = false;
            });
            
            this.wavesurfer.on('finish', () => {
                this.isPlaying = false;
                this.playNext();
            });

            this.wavesurfer.on('audioprocess', () => {
                this.progress = this.wavesurfer.getCurrentTime() / this.wavesurfer.getDuration() * 100;
                this.currentTime = this.formatTime(this.wavesurfer.getCurrentTime());
            });
        },
        
        loadTrack(track) {
            this.wavesurfer.load(track.file);
            this.wavesurfer.setVolume(this.volume / 100);
        },
        
        playTrack(index) {
            if (this.currentTrack === index) {
                this.togglePlay();
            } else {
                this.wavesurfer.pause();
                this.currentTrack = index;
            }
        },
        
        togglePlay() {
            this.wavesurfer.playPause();
        },

        playNext() {
            if (this.currentTrack < this.tracks.length - 1) {
                this.playTrack(this.currentTrack + 1);
            }
        },

        playPrevious() {
            if (this.currentTrack > 0) {
                this.playTrack(this.currentTrack - 1);
            }
        },

        formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = Math.floor(seconds % 60);
            return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`;
        },

        updateVolume() {
            this.wavesurfer.setVolume(this.volume / 100);
        },

        seekTo(event) {
            const rect = this.$refs.waveform.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const seekPercentage = x / rect.width;
            
            this.wavesurfer.seekTo(seekPercentage);
            
            if (!this.isPlaying) {
                this.togglePlay();
            }
        }
    }));
});