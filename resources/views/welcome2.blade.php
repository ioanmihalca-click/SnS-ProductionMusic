<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Snow N Stuff Production Music</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-black">
    <div x-data="{
            showContent: false,
            activeFeature: null,
            scrollPosition: 0,
            parallaxElements: [],
            audioPlaying: false,
            currentTrack: 0,
            audioTracks: [
                { name: 'Epic Orchestra', duration: '2:45' },
                { name: 'Cinematic Impact', duration: '3:15' },
                { name: 'Emotional Piano', duration: '4:00' }
            ],
            mouseX: 0,
            mouseY: 0,
            initParallax() {
                this.parallaxElements = document.querySelectorAll('[data-parallax]');
                this.updateParallax();
            },
            updateParallax() {
                requestAnimationFrame(() => {
                    this.parallaxElements.forEach(el => {
                        const speed = el.dataset.parallax || 0.1;
                        const offsetY = window.pageYOffset * speed;
                        const rotation = window.pageYOffset * 0.02;
                        
                        if(el.dataset.parallaxType === 'rotate') {
                            el.style.transform = `rotate(${rotation}deg)`;
                        } else {
                            el.style.transform = `translate3d(0, ${offsetY}px, 0)`;
                        }
                    });
                });
            }
        }" 
        x-init="setTimeout(() => showContent = true, 100);
                initParallax();
                window.addEventListener('scroll', () => {
                    scrollPosition = window.pageYOffset;
                    updateParallax();
                });
                window.addEventListener('mousemove', (e) => {
                    mouseX = (e.clientX / window.innerWidth - 0.5) * 2;
                    mouseY = (e.clientY / window.innerHeight - 0.5) * 2;
                });"
        @scroll.window="updateParallax"
        class="relative">

        <!-- Animated Background Elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <!-- Dynamic Gradient Orbs -->
            <div class="absolute w-[800px] h-[800px] rounded-full mix-blend-multiply filter blur-3xl opacity-30 bg-gradient-to-r from-red-500 to-purple-500 animate-pulse"
                x-bind:style="`transform: translate(${mouseX * 20}px, ${mouseY * 20}px)`"></div>
            <div class="absolute right-0 w-[600px] h-[600px] rounded-full mix-blend-multiply filter blur-3xl opacity-30 bg-gradient-to-l from-blue-500 to-purple-500 animate-pulse"
                x-bind:style="`transform: translate(${mouseX * -20}px, ${mouseY * -20}px)`"></div>
            
            <!-- Animated Lines -->
            <div class="absolute inset-0" 
                 x-data="{ lines: Array(5).fill().map(() => ({ 
                     left: Math.random() * 100,
                     duration: 3 + Math.random() * 4
                 })) }">
                <template x-for="(line, index) in lines" :key="index">
                    <div class="absolute w-px bg-gradient-to-b from-transparent via-red-500/20 to-transparent h-[50vh]"
                        :style="`left: ${line.left}%; animation: moveVertical ${line.duration}s infinite linear`"></div>
                </template>
            </div>
        </div>

        <!-- Hero Section -->
        <section class="relative flex items-center justify-center min-h-screen overflow-hidden">
            <!-- Parallax Hero Elements -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="relative w-full h-full max-w-6xl">
                    <!-- Circular Audio Visualizer -->
                    <div class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                         x-data="{ circles: Array(5).fill() }"
                         :class="audioPlaying ? 'scale-110' : 'scale-100'"
                         style="transition: transform 0.5s ease-out">
                        <template x-for="(circle, index) in circles" :key="index">
                            <div class="absolute border rounded-full border-red-500/30"
                                :style="`width: ${(index + 1) * 100}px; height: ${(index + 1) * 100}px; 
                                        animation: pulse ${2 + index * 0.5}s infinite ease-out;
                                        animation-delay: ${index * 0.2}s`"></div>
                        </template>
                    </div>

                    <!-- Hero Image with Parallax -->
                    <div class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 w-96 h-96"
                         data-parallax="0.1">
                        <img src="{{ asset('assets/hero-production-music.webp') }}" 
                             alt="Snow N Stuff Production Music"
                             class="object-cover w-full h-full transition-all duration-700 transform shadow-2xl rounded-2xl hover:scale-105"
                             :class="showContent ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                             style="transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1)">
                        
                        <!-- Play Button Overlay -->
                        <button @click="audioPlaying = !audioPlaying" 
                                class="absolute inset-0 flex items-center justify-center transition-all duration-300 bg-black/30 rounded-2xl hover:bg-black/50">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 :class="audioPlaying ? 'scale-90' : 'scale-100 hover:scale-110'"
                                 class="w-16 h-16 text-white transition-all duration-300 transform" 
                                 fill="none" 
                                 viewBox="0 0 24 24" 
                                 stroke="currentColor">
                                <path stroke-linecap="round" 
                                      stroke-linejoin="round" 
                                      stroke-width="2" 
                                      :d="audioPlaying ? 'M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z' : 'M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z M21 12a9 9 0 11-18 0 9 9 0 0118 0z'" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Hero Content -->
            <div class="relative z-10 max-w-4xl px-4 text-center">
                <!-- Dynamic Title Animation -->
                <h1 class="mb-6 text-5xl font-bold tracking-tight text-white"
                    x-data="{ words: ['Captivate', 'Inspire', 'Elevate'], currentWord: 0 }"
                    x-init="setInterval(() => currentWord = (currentWord + 1) % words.length, 2000)">
                    <span class="block mb-2 text-2xl font-normal text-red-500"
                          x-text="words[currentWord]"
                          x-transition:enter="transition ease-out duration-300"
                          x-transition:enter-start="opacity-0 transform translate-y-4"
                          x-transition:enter-end="opacity-100 transform translate-y-0"></span>
                    Your Story Through Music
                </h1>

                <!-- Track List -->
                <div class="max-w-md p-4 mx-auto mb-8 border rounded-lg backdrop-blur-md bg-white/5 border-white/10"
                     x-show="showContent"
                     x-transition:enter="transition ease-out duration-500 delay-300"
                     x-transition:enter-start="opacity-0 transform translate-y-4"
                     x-transition:enter-end="opacity-100 transform translate-y-0">
                    <template x-for="(track, index) in audioTracks" :key="index">
                        <div class="flex items-center justify-between px-3 py-2 transition-all duration-300 rounded-lg"
                             :class="currentTrack === index && audioPlaying ? 'bg-red-500/20' : 'hover:bg-white/5'"
                             @click="currentTrack = index; audioPlaying = true">
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-red-500/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                         class="w-4 h-4 text-red-500" 
                                         :class="currentTrack === index && audioPlaying ? 'animate-pulse' : ''"
                                         fill="none" 
                                         viewBox="0 0 24 24" 
                                         stroke="currentColor">
                                        <path stroke-linecap="round" 
                                              stroke-linejoin="round" 
                                              stroke-width="2" 
                                              d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                    </svg>
                                </div>
                                <span class="text-white" x-text="track.name"></span>
                            </div>
                            <span class="text-sm text-gray-400" x-text="track.duration"></span>
                        </div>
                    </template>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-wrap justify-center gap-4">
                    <button class="px-8 py-3 text-lg font-semibold text-white transition-all duration-300 transform bg-red-500 rounded-lg hover:scale-105 hover:bg-red-600 hover:shadow-lg hover:shadow-red-500/25">
                        Start Creating
                    </button>
                    <button class="px-8 py-3 text-lg font-semibold text-white transition-all duration-300 transform border rounded-lg border-white/50 hover:scale-105 hover:bg-white hover:text-black hover:shadow-lg">
                        Learn More
                    </button>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute transform -translate-x-1/2 bottom-8 left-1/2"
                 x-show="showContent"
                 x-transition:enter="transition ease-out duration-500 delay-500"
                 x-transition:enter-start="opacity-0 transform translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0">
                <div class="flex items-start justify-center w-8 h-12 p-2 border-2 rounded-full border-white/30">
                    <div class="w-1 h-3 rounded-full bg-white/70 animate-bounce"></div>
                </div>
            </div>
        </section>

        <!-- Stylized Animation Keyframes -->
        <style>
            @keyframes moveVertical {
                from { transform: translateY(-100%); }
                to { transform: translateY(100%); }
            }
            
            @keyframes pulse {
                0% { transform: scale(1); opacity: 0.5; }
                50% { transform: scale(1.1); opacity: 0.3; }
                100% { transform: scale(1); opacity: 0.5; }
            }
            
            .animate-pulse {
                animation: pulse 2s infinite;
            }
        </style>

        <!-- Features Section -->
<section class="relative py-20 overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute w-[500px] h-[500px] -right-48 top-0 rounded-full mix-blend-multiply filter blur-3xl opacity-20 bg-gradient-to-br from-red-500 to-purple-500"></div>
        <div class="absolute w-[500px] h-[500px] -left-48 bottom-0 rounded-full mix-blend-multiply filter blur-3xl opacity-20 bg-gradient-to-tr from-blue-500 to-purple-500"></div>
    </div>

    <div class="container relative px-4 mx-auto max-w-7xl">
        <!-- Section Title -->
        <div class="mb-16 text-center"
             x-intersect:enter="transition duration-1000 ease-out"
             x-intersect:enter-start="opacity-0 transform translate-y-8"
             x-intersect:enter-end="opacity-100 transform translate-y-0">
            <h2 class="mb-4 text-3xl font-bold text-white md:text-4xl">Our Services</h2>
            <p class="max-w-2xl mx-auto text-gray-400">Experience the perfect blend of creativity and technical excellence with our comprehensive music production services.</p>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <template x-for="(feature, index) in features" :key="index">
                <div class="relative group"
                     x-intersect:enter="transition duration-700 ease-out"
                     x-intersect:enter-start="opacity-0 transform translate-y-8"
                     x-intersect:enter-end="opacity-100 transform translate-y-0"
                     :style="`transition-delay: ${index * 100}ms`">
                    <!-- Card -->
                    <div class="relative p-6 transition-all duration-300 border border-gray-800 rounded-xl backdrop-blur-sm bg-black/20 group-hover:border-red-500/50 group-hover:transform group-hover:-translate-y-2">
                        <!-- Icon -->
                        <div class="flex items-center justify-center w-12 h-12 mb-4 transition-transform duration-300 rounded-lg bg-gradient-to-br from-red-500/20 to-purple-500/20 group-hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 class="w-6 h-6 text-red-500" 
                                 fill="none" 
                                 viewBox="0 0 24 24" 
                                 stroke="currentColor">
                                <path stroke-linecap="round" 
                                      stroke-linejoin="round" 
                                      stroke-width="2" 
                                      :d="feature.icon" />
                            </svg>
                        </div>

                        <!-- Content -->
                        <h3 class="mb-2 text-xl font-bold text-white transition-colors duration-300 group-hover:text-red-500" 
                            x-text="feature.title"></h3>
                        <p class="text-gray-400 transition-colors duration-300 group-hover:text-gray-300" 
                           x-text="feature.description"></p>

                        <!-- Hover Effect -->
                        <div class="absolute inset-0 transition-opacity duration-300 opacity-0 pointer-events-none rounded-xl group-hover:opacity-100">
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-red-500/10 to-purple-500/10"></div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="relative pt-20 pb-10 overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute bottom-0 w-full h-px bg-gradient-to-r from-transparent via-red-500/20 to-transparent"></div>
        <div class="absolute w-[500px] h-[500px] -left-48 -bottom-48 rounded-full mix-blend-multiply filter blur-3xl opacity-20 bg-gradient-to-br from-red-500 to-purple-500"></div>
    </div>

    <div class="container relative px-4 mx-auto max-w-7xl">
        <!-- Footer Grid -->
        <div class="grid grid-cols-1 gap-12 mb-12 md:grid-cols-4"
             x-intersect:enter="transition duration-1000 ease-out"
             x-intersect:enter-start="opacity-0 transform translate-y-8"
             x-intersect:enter-end="opacity-100 transform translate-y-0">
            <!-- Brand Column -->
            <div class="col-span-1">
                <img src="{{ asset('logo.png') }}" alt="Snow N Stuff" class="h-8 mb-6">
                <p class="mb-6 text-gray-400">Creating powerful music for your stories since 2024</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 transition-colors duration-300 hover:text-red-500">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 transition-colors duration-300 hover:text-red-500">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 transition-colors duration-300 hover:text-red-500">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-span-1">
                <h4 class="mb-6 font-bold text-white">Quick Links</h4>
                <ul class="space-y-4">
                    <li><a href="#" class="text-gray-400 transition-colors duration-300 hover:text-red-500">About Us</a></li>
                    <li><a href="#" class="text-gray-400 transition-colors duration-300 hover:text-red-500">Services</a></li>
                    <li><a href="#" class="text-gray-400 transition-colors duration-300 hover:text-red-500">Music Library</a></li>
                    <li><a href="#" class="text-gray-400 transition-colors duration-300 hover:text-red-500">Licensing</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-span-1">
                <h4 class="mb-6 font-bold text-white">Contact</h4>
                <ul class="space-y-4">
                    <li class="flex items-center space-x-3 text-gray-400">
                        <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>contact@snownstuff.com</span>
                    </li>
                    <li class="flex items-center space-x-3 text-gray-400">
                        <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>+1 (555) 123-4567</span>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="col-span-1">
              <h4 class="mb-6 font-bold text-white">Newsletter</h4>
                <p class="mb-4 text-gray-400">Stay updated with our latest releases and music production tips.</p>
                <form class="space-y-3">
                    <div class="relative">
                        <input type="email" 
                               placeholder="Enter your email" 
                               class="w-full px-4 py-3 text-gray-300 placeholder-gray-500 transition-colors duration-300 border border-gray-800 rounded-lg bg-white/5 focus:outline-none focus:border-red-500">
                    </div>
                    <button type="submit" 
                            class="w-full px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 transform hover:-translate-y-0.5">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="relative pt-8 mt-12 border-t border-gray-800">
            <div class="flex flex-col items-center justify-between space-y-4 md:flex-row md:space-y-0">
                <div class="text-sm text-gray-400">
                    &copy; 2024 Snow N Stuff Production Music. All rights reserved.
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-sm text-gray-400 transition-colors duration-300 hover:text-red-500">Privacy Policy</a>
                    <a href="#" class="text-sm text-gray-400 transition-colors duration-300 hover:text-red-500">Terms of Service</a>
                </div>
                <div class="text-sm text-gray-400">
                    Web Development by 
                    <a href="https://clickstudiosdigital.com" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="text-red-500 transition-colors duration-300 hover:text-red-400">
                        Click Studios Digital
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll to Top Button -->
        <button @click="window.scrollTo({top: 0, behavior: 'smooth'})"
                x-data="{ showButton: false }"
                @scroll.window="showButton = (window.pageYOffset > 100)"
                x-show="showButton"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform translate-y-2"
                class="fixed p-2 text-white transition-all duration-300 transform bg-red-500 rounded-full shadow-lg bottom-8 right-8 hover:bg-red-600 hover:-translate-y-1">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
            </svg>
        </button>
    </div>
</footer>

</div>
@livewireScripts

<!-- Additional Styles for Animations -->
<style>
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }

    .floating {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .animated-gradient {
        background-size: 200% 200%;
        animation: gradient 15s ease infinite;
    }
</style>

</body>
</html>

    </div>
    @livewireScripts
</body>

</html>
