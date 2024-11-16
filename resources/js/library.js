import WaveSurfer from "wavesurfer.js";
import Hover from "wavesurfer.js/dist/plugins/hover.esm.js";

document.addEventListener("alpine:init", () => {
    Alpine.data("libraryPlayer", () => ({
        wavesurfer: null,
        currentTrack: null,
        isPlaying: false,
        tracks: [],
        progress: 0,
        currentTime: "0:00",
        volume: 80,
        showVolume: false,
        loading: false,

        init() {
            this.initWaveSurfer();

            // Ascultăm pentru evenimente de la Livewire
            Livewire.on('initPersistentPlayer', (data) => {
                console.log('Received track:', data);
                // Extragem trackData din obiectul wrapper
                const track = data.trackData;
                
                if (!track) {
                    console.error('No track data received');
                    return;
                }
            
                // Adăugăm track-ul în playlist dacă nu există
                if (!this.tracks.find(t => t.id === track.id)) {
                    this.tracks.push(track);
                }
                
                // Setăm indexul track-ului curent
                this.currentTrack = this.tracks.findIndex(t => t.id === track.id);
                
                // Încărcăm track-ul
                this.loadTrack(track);
            });

            // Adaugă event listener pentru ESC
            window.addEventListener("keydown", this.handleEscKey.bind(this));

            // Cleanup la distrugerea componentei
            this.$cleanup(() => {
                window.removeEventListener(
                    "keydown",
                    this.handleEscKey.bind(this)
                );
                this.wavesurfer?.destroy();
            });
        },

        handleEscKey(e) {
            if (e.key === "Escape" && this.currentTrack !== null) {
                this.wavesurfer?.pause();
                this.currentTrack = null;
            }
        },

        initWaveSurfer() {
            // Verificăm dacă există deja o instanță
            if (this.wavesurfer) {
                this.wavesurfer.destroy();
            }
        
            // Debug pentru a verifica dacă găsim containerul
            console.log('Waveform container:', this.$refs.waveform);
        
            this.wavesurfer = WaveSurfer.create({
                container: this.$refs.waveform,
                waveColor: "#FFFFFF",
                progressColor: "#EF4444",
                cursorColor: "#EF4444",
                barWidth: 2,
                barGap: 1,
                barRadius: 3,
                height: 48,
                normalize: true,
                hideScrollbar: true,
                plugins: [
                    Hover.create({
                        lineColor: "#EF4444",
                        labelBackground: "#1F2937",
                        labelColor: "#ffffff",
                    }),
                ],
            });
        
            console.log('WaveSurfer instance created:', this.wavesurfer); // Debug
        
            this.wavesurfer.on("play", () => {
                console.log('Track playing'); // Debug
                this.isPlaying = true;
            });
        
            this.wavesurfer.on("pause", () => {
                console.log('Track paused'); // Debug
                this.isPlaying = false;
            });
        
            this.wavesurfer.on("finish", () => {
                console.log('Track finished'); // Debug
                this.isPlaying = false;
                this.playNext();
            });
        
            this.wavesurfer.on("audioprocess", () => {
                this.progress = (this.wavesurfer.getCurrentTime() / this.wavesurfer.getDuration()) * 100;
                this.currentTime = this.formatTime(this.wavesurfer.getCurrentTime());
            });
        
            // Setăm volumul inițial
            this.wavesurfer.setVolume(this.volume / 100);
        },
        
        loadTrack(track) {
            console.log('Loading track:', track); // Debug
            if (!track?.file) {
                console.error('No track file provided:', track);
                return;
            }
        
            const wasPlaying = this.isPlaying;
            this.isPlaying = false;
            this.loading = true;
        
            try {
                console.log('Loading file:', track.file); // Debug
                this.wavesurfer.load(track.file);
        
                this.wavesurfer.once('loading', (progress) => {
                    console.log('Loading progress:', progress); // Debug
                    this.loading = progress < 100;
                });
        
                this.wavesurfer.once('ready', () => {
                    console.log('Track ready'); // Debug
                    this.loading = false;
                    this.wavesurfer.play();
                    this.isPlaying = true;
                });
        
                this.wavesurfer.once('error', (err) => {
                    console.error('Error loading track:', err);
                    this.loading = false;
                    this.isPlaying = false;
                });
            } catch (error) {
                console.error('Error in loadTrack:', error);
                this.loading = false;
                this.isPlaying = false;
            }
        },

        togglePlay() {
            this.wavesurfer?.playPause();
        },

        playNext() {
            if (this.currentTrack < this.tracks.length - 1) {
                this.currentTrack++;
                this.loadTrack(this.tracks[this.currentTrack]);
            }
        },

        playPrevious() {
            if (this.currentTrack > 0) {
                this.currentTrack--;
                this.loadTrack(this.tracks[this.currentTrack]);
            }
        },

        formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = Math.floor(seconds % 60);
            return `${minutes}:${remainingSeconds.toString().padStart(2, "0")}`;
        },

        updateVolume() {
            this.wavesurfer?.setVolume(this.volume / 100);
        },

        seekTo(event) {
            const rect = this.$refs.waveform.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const seekPercentage = x / rect.width;
            this.wavesurfer?.seekTo(seekPercentage);

            if (!this.isPlaying) {
                this.togglePlay();
            }
        },

        closePlayer() {
            this.wavesurfer?.pause();
            this.currentTrack = null;
        },
    }));
});
