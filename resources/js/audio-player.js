// resources/js/audio-player.js
import WaveSurfer from "wavesurfer.js";
import Hover from "wavesurfer.js/dist/plugins/hover.esm.js";

document.addEventListener("alpine:init", () => {
    Alpine.data("audioPlayer", (tracks) => ({
        wavesurfer: null,
        currentTrack: null,
        isPlaying: false,
        tracks: tracks,
        progress: 0,
        currentTime: "0:00",
        volume: 80,
        showVolume: false,

        init() {
            this.initWaveSurfer();
            this.$watch("currentTrack", (value) => {
                if (value !== null) {
                    this.loadTrack(this.tracks[value]);
                }
            });
            // Adaugă event listener pentru ESC
            window.addEventListener("keydown", this.handleEscKey.bind(this));

            // Cleanup la distrugerea componentei
            this.$cleanup(() => {
                window.removeEventListener(
                    "keydown",
                    this.handleEscKey.bind(this)
                );
            });
        },

        // Metodă separată pentru handler
        handleEscKey(e) {
            if (e.key === "Escape" && this.currentTrack !== null) {
                this.wavesurfer?.pause();
                this.currentTrack = null;
            }
        },

        initWaveSurfer() {
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

            this.wavesurfer.on("play", () => {
                this.isPlaying = true;
            });

            this.wavesurfer.on("pause", () => {
                this.isPlaying = false;
            });

            this.wavesurfer.on("finish", () => {
                this.isPlaying = false;
                this.playNext();
            });

            this.wavesurfer.on("audioprocess", () => {
                this.progress =
                    (this.wavesurfer.getCurrentTime() /
                        this.wavesurfer.getDuration()) *
                    100;
                this.currentTime = this.formatTime(
                    this.wavesurfer.getCurrentTime()
                );
            });

            // Adăugăm un eveniment pentru când track-ul este pregătit
            this.wavesurfer.on("ready", () => {
                if (this.isPlaying) {
                    this.wavesurfer.play();
                }
            });
        },

        loadTrack(track) {
            if (!track?.file) return;
        
            // Salvăm starea de redare înainte de încărcare
            const wasPlaying = this.isPlaying;
            this.isPlaying = false;
            this.loading = true;
        
            try {
                this.wavesurfer.load(track.file);
                this.wavesurfer.setVolume(this.volume / 100);
        
                // Configurăm event listeners pentru loading states
                this.wavesurfer.once('loading', (progress) => {
                    this.loading = progress < 100;
                });
        
                this.wavesurfer.once('ready', () => {
                    this.loading = false;
                    if (wasPlaying) {
                        this.wavesurfer.play();
                        this.isPlaying = true;
                    }
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

        playTrack(index) {
            if (this.currentTrack === index) {
                this.togglePlay();
            } else {
                const wasPlaying = this.isPlaying; // Salvăm starea de redare
                this.isPlaying = true; // Setăm că vrem să cânte
                this.wavesurfer.pause();
                this.currentTrack = index;

                // Așteptăm încărcarea și apoi pornim redarea
                this.wavesurfer.once("ready", () => {
                    this.wavesurfer.play();
                });
            }
        },

        togglePlay() {
            this.wavesurfer.playPause();
        },

        playNext() {
            if (this.currentTrack < this.tracks.length - 1) {
                const wasPlaying = this.isPlaying;
                this.isPlaying = wasPlaying; // Păstrăm starea de redare
                this.playTrack(this.currentTrack + 1);
            }
        },

        playPrevious() {
            if (this.currentTrack > 0) {
                const wasPlaying = this.isPlaying;
                this.isPlaying = wasPlaying; // Păstrăm starea de redare
                this.playTrack(this.currentTrack - 1);
            }
        },

        formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = Math.floor(seconds % 60);
            return `${minutes}:${remainingSeconds.toString().padStart(2, "0")}`;
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
        },
    }));
});
