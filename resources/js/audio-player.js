// resources/js/audio-player.js
import WaveSurfer from "wavesurfer.js";
import Hover from "wavesurfer.js/dist/plugins/hover.esm.js";

document.addEventListener("alpine:init", () => {
    Alpine.data("audioPlayer", (tracks) => ({
        wavesurfer: null,
        wavesurferMobile: null,
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

            window.addEventListener("resize", () => {
                if (this.wavesurfer) {
                    this.wavesurfer.setHeight(40);
                }
                if (this.wavesurferMobile) {
                    this.wavesurferMobile.setHeight(40);
                }
            });
        },

        initWaveSurfer() {
            // Configurare comună
            const commonConfig = {
                container: this.$refs.waveform,
                waveColor: "#4F4A85",
                progressColor: "#EF4444",
                cursorColor: "#EF4444",
                barWidth: 2,
                barGap: 1,
                barRadius: 3,
                height: 32,
                normalize: true,
                hideScrollbar: true,
                responsive: true,
                interact: true,
                plugins: [
                    Hover.create({
                        lineColor: "#EF4444",
                        labelBackground: "#1F2937",
                        labelColor: "#ffffff",
                    }),
                ],
            };

            // Inițializare waveform desktop
            if (this.$refs.waveform) {
                this.wavesurfer = WaveSurfer.create({
                    ...commonConfig,
                    container: this.$refs.waveform,
                });
            }

            // Inițializare waveform mobil
            // Pentru mobil
            if (this.$refs.waveformMobile) {
                this.wavesurferMobile = WaveSurfer.create({
                    ...commonConfig,
                    container: this.$refs.waveformMobile,
                    height: 24,
                });
            }

            // Funcție pentru actualizarea timpului
            const updateTime = () => {
                if (this.wavesurfer) {
                    this.currentTime = this.formatTime(
                        this.wavesurfer.getCurrentTime()
                    );
                    this.progress =
                        (this.wavesurfer.getCurrentTime() /
                            this.wavesurfer.getDuration()) *
                        100;
                }
            };

            // Sincronizare între waveform-uri
            const updateProgress = (time) => {
                if (this.wavesurfer) {
                    this.wavesurfer.seekTo(time);
                }
                if (this.wavesurferMobile) {
                    this.wavesurferMobile.seekTo(time);
                }
            };

            [this.wavesurfer, this.wavesurferMobile].forEach((ws) => {
                if (ws) {
                    ws.on("play", () => {
                        this.isPlaying = true;
                        if (ws === this.wavesurfer && this.wavesurferMobile) {
                            this.wavesurferMobile.play();
                        } else if (
                            ws === this.wavesurferMobile &&
                            this.wavesurfer
                        ) {
                            this.wavesurfer.play();
                        }
                    });

                    ws.on("pause", () => {
                        this.isPlaying = false;
                        if (ws === this.wavesurfer && this.wavesurferMobile) {
                            this.wavesurferMobile.pause();
                        } else if (
                            ws === this.wavesurferMobile &&
                            this.wavesurfer
                        ) {
                            this.wavesurfer.pause();
                        }
                    });

                    ws.on("finish", () => {
                        this.isPlaying = false;
                        this.playNext();
                    });

                    ws.on("seeking", (time) => updateProgress(time));
                    ws.on("audioprocess", updateTime);
                }
            });
        },

        loadTrack(track) {
            const loadAndPlay = () => {
                if (this.wavesurfer) {
                    this.wavesurfer.load(track.file);
                    this.wavesurfer.setVolume(this.volume / 100);
                }
                if (this.wavesurferMobile) {
                    this.wavesurferMobile.load(track.file);
                    this.wavesurferMobile.setVolume(this.volume / 100);
                }
            };

            // Oprește track-ul curent înainte de a încărca unul nou
            if (this.wavesurfer) {
                this.wavesurfer.pause();
            }
            if (this.wavesurferMobile) {
                this.wavesurferMobile.pause();
            }

            loadAndPlay();
        },

        playTrack(index) {
            if (this.currentTrack === index) {
                this.togglePlay();
            } else {
                this.currentTrack = index;
                // Pornește automat după încărcarea track-ului
                if (this.wavesurfer) {
                    this.wavesurfer.once("ready", () => {
                        this.togglePlay();
                    });
                }
            }
        },

        togglePlay() {
            if (this.wavesurfer) {
                this.wavesurfer.playPause();
            }
            if (this.wavesurferMobile) {
                this.wavesurferMobile.playPause();
            }
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
            return `${minutes}:${remainingSeconds.toString().padStart(2, "0")}`;
        },

        updateVolume() {
            const volume = this.volume / 100;
            if (this.wavesurfer) {
                this.wavesurfer.setVolume(volume);
            }
            if (this.wavesurferMobile) {
                this.wavesurferMobile.setVolume(volume);
            }
        },

        seekTo(event) {
            const wavesurfer = event.target.closest(".md\\:hidden")
                ? this.wavesurferMobile
                : this.wavesurfer;
            if (!wavesurfer) return;

            const rect = event.currentTarget.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const seekPercentage = x / rect.width;

            wavesurfer.seekTo(seekPercentage);

            if (!this.isPlaying) {
                this.togglePlay();
            }
        },

        destroy() {
            if (this.wavesurfer) {
                this.wavesurfer.destroy();
            }
            if (this.wavesurferMobile) {
                this.wavesurferMobile.destroy();
            }
        },
    }));
});
