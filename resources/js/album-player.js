
import WaveSurfer from "wavesurfer.js";
import Hover from "wavesurfer.js/dist/plugins/hover.esm.js";

document.addEventListener("alpine:init", () => {
    Alpine.data("albumPlayer", (albums) => ({
        wavesurfer: null,
        currentAlbum: null,
        currentTrackIndex: null,
        isPlaying: false,
        albums: albums,
        progress: 0,
        currentTime: "0:00",
        volume: 80,
        showVolume: false,
        loading: false,

        init() {
            this.initWaveSurfer();
            
            // Watch pentru schimbări în track-ul curent
            this.$watch("currentTrackIndex", (value) => {
                if (this.currentAlbum !== null && value !== null) {
                    this.loadTrack(this.albums[this.currentAlbum].tracks[value]);
                }
            });

            window.addEventListener("keydown", this.handleEscKey.bind(this));

            this.$cleanup(() => {
                window.removeEventListener("keydown", this.handleEscKey.bind(this));
            });
        },

        handleEscKey(e) {
            if (e.key === "Escape" && this.currentAlbum !== null) {
                this.wavesurfer?.pause();
                this.closePlayer();
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
                this.progress = (this.wavesurfer.getCurrentTime() / this.wavesurfer.getDuration()) * 100;
                this.currentTime = this.formatTime(this.wavesurfer.getCurrentTime());
            });

            this.wavesurfer.on("ready", () => {
                if (this.isPlaying) {
                    this.wavesurfer.play();
                }
            });
        },

        loadTrack(track) {
            if (!track?.file) return;
            
            const wasPlaying = this.isPlaying;
            this.isPlaying = false;
            this.loading = true;
        
            try {
                this.wavesurfer.load(track.file);
                this.wavesurfer.setVolume(this.volume / 100);
        
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

        toggleAlbum(albumIndex) {
            this.currentAlbum = this.currentAlbum === albumIndex ? null : albumIndex;
            if (this.currentAlbum === null) {
                this.currentTrackIndex = null;
                this.wavesurfer?.pause();
            }
        },

        playTrack(albumIndex, trackIndex) {
            if (this.currentAlbum === albumIndex && this.currentTrackIndex === trackIndex) {
                this.togglePlay();
            } else {
                const wasPlaying = this.isPlaying;
                this.isPlaying = true;
                this.wavesurfer?.pause();
                this.currentAlbum = albumIndex;
                this.currentTrackIndex = trackIndex;
            }
        },

        togglePlay() {
            this.wavesurfer?.playPause();
        },

        playNext() {
            if (this.currentAlbum === null || this.currentTrackIndex === null) return;

            const currentAlbumTracks = this.albums[this.currentAlbum].tracks;
            if (this.currentTrackIndex < currentAlbumTracks.length - 1) {
                // Mai sunt track-uri în albumul curent
                const wasPlaying = this.isPlaying;
                this.isPlaying = wasPlaying;
                this.playTrack(this.currentAlbum, this.currentTrackIndex + 1);
            } else if (this.currentAlbum < this.albums.length - 1) {
                // Trecem la următorul album
                const wasPlaying = this.isPlaying;
                this.isPlaying = wasPlaying;
                this.playTrack(this.currentAlbum + 1, 0);
            }
        },

        playPrevious() {
            if (this.currentAlbum === null || this.currentTrackIndex === null) return;

            if (this.currentTrackIndex > 0) {
                // Mai sunt track-uri anterioare în albumul curent
                const wasPlaying = this.isPlaying;
                this.isPlaying = wasPlaying;
                this.playTrack(this.currentAlbum, this.currentTrackIndex - 1);
            } else if (this.currentAlbum > 0) {
                // Trecem la albumul anterior, ultimul track
                const wasPlaying = this.isPlaying;
                this.isPlaying = wasPlaying;
                const previousAlbumIndex = this.currentAlbum - 1;
                const lastTrackIndex = this.albums[previousAlbumIndex].tracks.length - 1;
                this.playTrack(previousAlbumIndex, lastTrackIndex);
            }
        },

        closePlayer() {
            this.currentAlbum = null;
            this.currentTrackIndex = null;
            this.isPlaying = false;
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
    }));
});