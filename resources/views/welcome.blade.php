<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Snow N Stuff Production Music</title>

      <!-- Favicons -->
    <link rel="icon" href="{{ asset('assets/favicon/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/favicon/favicon.svg') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png') }}">
    <meta name="apple-mobile-web-app-title" content="SnS">
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest') }}">

    <meta name="description"
        content="Your ultimate source for exclusive, emotion-driven production music. Professional music library for TV, film, and advertising.">
    <meta property="og:title" content="Snow N Stuff Production Music">
    <meta property="og:description" content="Your ultimate source for exclusive, emotion-driven production music.">
    <meta property="og:image" content="{{ asset('assets/og-image.jpg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="min-h-screen bg-gradient-to-b from-black via-gray-900 to-black">
    <div class="relative overflow-hidden" x-data="{
        showContent: false,
        activeFeature: null,
        scrollPosition: 0,
        featuresVisible: false,
        features: [{
                title: 'Custom Production',
                description: 'Tailored music creation to perfectly match your project\'s unique requirements.',
                icon: 'm9 9 10.5-3m0 6.553v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 1 1-.99-3.467l2.31-.66a2.25 2.25 0 0 0 1.632-2.163Zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 0 1-.99-3.467l2.31-.66A2.25 2.25 0 0 0 9 15.553Z'
            },
            {
                title: 'Flexible Licensing',
                description: 'Simple and adaptable licensing options to suit your needs and budget.',
                icon: 'M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z'
            },
            {
                title: 'Sound Design',
                description: 'Professional sound design services to enhance your production value.',
                icon: 'M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75'
            }
        ],
        initAnimations() {
            this.showContent = false;
            setTimeout(() => {
                this.showContent = true;
                this.initializeTextAnimation();
            }, 100);
        },
        initializeTextAnimation() {
            const textElement = this.$refs.typingText;
            const finalText = textElement.dataset.text;
            textElement.textContent = '';
    
            let i = 0;
            const typeText = () => {
                if (i <= finalText.length) {
                    textElement.textContent = finalText.substring(0, i);
                    i++;
                    setTimeout(typeText, 30);
                }
            };
            setTimeout(() => typeText(), 800);
        }
    }" x-init="initAnimations();
    window.addEventListener('scroll', () => {
        scrollPosition = window.pageYOffset;
    });
    
    window.addEventListener('popstate', () => initAnimations());
    
    window.addEventListener('pageshow', (event) => {
        if (event.persisted) {
            initAnimations();
        }
    });">

        <!-- Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute hidden rounded-full w-96 md:block h-96 blur-3xl -top-48 -left-48 bg-red-900/50"
                x-bind:class="showContent ? 'opacity-100' : 'opacity-0'"
                x-bind:style="'transform: translate(' + scrollPosition * 0.05 + 'px, ' + scrollPosition * 0.05 + 'px)'"
                style="transition: opacity 1s ease-out"></div>
            <div class="absolute rounded-full w-96 h-96 blur-3xl -bottom-48 -right-48 bg-red-900/50"
                x-bind:class="showContent ? 'opacity-100' : 'opacity-0'"
                x-bind:style="'transform: translate(-' + scrollPosition * 0.05 + 'px, -' + scrollPosition * 0.05 + 'px)'"
                style="transition: opacity 1s ease-out; transition-delay: 0.3s"></div>
        </div>



        <!-- Main Content -->
        <main class="relative flex flex-col items-center justify-center px-4 py-16 overflow-hidden">
            <!-- Logo and Hero Image -->
    <div class="relative mb-2 transform rounded-2xl" 
        x-bind:class="showContent ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
        style="transition: all 0.8s ease-out">
        <div class="absolute inset-0 bg-gradient-to-b from-black/0 via-black/10 to-black/30 rounded-2xl"></div>
        <img src="{{ asset('assets/hero-production-music.webp') }}" alt="Snow N Stuff Production Music"
            class="mx-auto transition-all duration-700 shadow-2xl hover:scale-105 rounded-2xl hover:shadow-red-900/20 w-[32rem]"
            x-bind:style="'transform: translateY(' + scrollPosition * 0.1 + 'px)'">
        
        <!-- Floating badges -->
        {{-- <div class="absolute top-0 right-0 px-4 py-2 -mt-4 -mr-4 text-sm font-semibold text-white transform rounded-lg shadow-lg rotate-2 bg-gradient-to-r from-red-600 to-red-700">
            Premium Quality
        </div> --}}
        {{-- <div class="absolute bottom-0 left-0 px-4 py-2 -mb-4 -ml-4 text-sm font-semibold text-white transform rounded-lg shadow-lg -rotate-2 bg-gradient-to-r from-purple-600 to-purple-700">
            Exclusive Content
        </div> --}}
    </div>
               <!-- Introduction Text -->
    <div class="max-w-2xl p-8 text-center transform border shadow-xl font-roboto-condensed bg-black/20 rounded-2xl border-gray-800/50"
        x-bind:class="showContent ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
        style="transition: all 0.8s ease-out; transition-delay: 0.2s">
        
        <!-- Main Headline -->
        <h1 class="mb-4">
            <span class="block text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-purple-500" 
                  x-ref="typingText" 
                  data-text="Premium Production Music Library">
            </span>
            <span class="text-xl font-medium text-gray-400">Elevate Your Content with Professional Sound</span>
        </h1>

        <!-- Value Propositions -->
        <div class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-2">
            <div class="p-4 transition-all duration-300 border border-gray-800 rounded-lg hover:border-red-500/50 hover:bg-red-500/5">
                <h3 class="mb-2 text-lg font-semibold text-white">Exclusive Library</h3>
                <p class="text-sm text-gray-400">Unique, high-quality tracks crafted for professional productions</p>
            </div>
            <div class="p-4 transition-all duration-300 border border-gray-800 rounded-lg hover:border-red-500/50 hover:bg-red-500/5">
                <h3 class="mb-2 text-lg font-semibold text-white">Custom Solutions</h3>
                <p class="text-sm text-gray-400">Tailored music creation for your specific project needs</p>
            </div>
        </div>

        <!-- Introduction Paragraphs -->
        <div class="mt-8 space-y-4">
            <template x-for="(delay, index) in [1.2, 1.5]">
                <p class="text-base transition-all duration-1000 transform text-gray-300/90"
                    x-bind:class="showContent ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
                    :style="`transition-delay: ${delay}s`"
                    x-text="[
                        'Welcome to Snow N Stuff Production Music, where we craft powerful, emotion-driven soundtracks for TV series, cinematic trailers, and high-impact advertisements. Our boutique library offers unique sounds that elevate your vision beyond the ordinary.',
                        'With flexible licensing options and expert sound design services, we\'re committed to making your project stand out. Every piece in our collection is carefully curated to ensure maximum impact and professional quality.'
                    ][index]">
                </p>
            </template>
        </div>

        <!-- Trust Indicators -->
        <div class="flex flex-wrap items-center justify-center gap-6 mt-8">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <span class="text-sm font-medium text-gray-400">Trusted since 2017</span>
            </div>
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm font-medium text-gray-400">100% Original Content</span>
            </div>
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                <span class="text-sm font-medium text-gray-400">Fast Delivery</span>
            </div>
        </div>
    </div>

            <!-- Track List Preview -->
<div class="max-w-md mx-auto mb-8"
     x-show="showContent"
     x-transition:enter="transition ease-out duration-500 delay-300"
     x-transition:enter-start="opacity-0 transform translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0">
    <livewire:audio-player />
</div>

            <!-- CTA Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-4 pt-8 transform"
                x-bind:class="showContent ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
                style="transition: all 0.8s ease-out; transition-delay: 0.4s">
                <button
                    class="group relative px-8 py-3 text-lg font-semibold text-white transition-all duration-300 bg-gradient-to-r from-red-600 to-red-800 rounded-lg hover:shadow-xl hover:shadow-red-900/20 hover:-translate-y-0.5 overflow-hidden">
                    <span
                        class="relative z-10 transition-transform duration-500 group-hover:-translate-y-[120%] inline-block">
                        Explore Library
                    </span>
                    <span
                        class="absolute inset-0 flex items-center justify-center transition-transform duration-500 translate-y-[120%] group-hover:translate-y-0">
                        Start Creating
                    </span>
                </button>
                <button
                    class="group relative px-8 py-3 text-lg font-semibold text-white transition-all duration-300 border border-white/50 rounded-lg hover:bg-white hover:text-black hover:border-white hover:shadow-xl hover:-translate-y-0.5 backdrop-blur-sm overflow-hidden">
                    <span
                        class="relative z-10 transition-transform duration-500 group-hover:-translate-y-[120%] inline-block">
                        Contact Us
                    </span>
                    <span
                        class="absolute inset-0 flex items-center justify-center transition-transform duration-500 translate-y-[120%] group-hover:translate-y-0">
                        Get in Touch
                    </span>
                </button>
            </div>
        </main>

        <!-- Company Logo -->
        <x-company-logo />


        <!-- Features Grid -->
        <div class="container grid grid-cols-1 gap-8 px-4 py-20 mx-auto md:grid-cols-3 max-w-7xl"
            x-intersect="featuresVisible = true">
            <template x-for="(feature, index) in features" :key="index">
                <div class="p-6 transition-all duration-500 border cursor-pointer border-gray-800/70 rounded-xl hover:border-red-600 hover:shadow-xl hover:shadow-red-900/20 backdrop-blur-sm bg-black/20 group"
                    @mouseenter="activeFeature = index" @mouseleave="activeFeature = null"
                    :class="{ 'transform -translate-y-2': activeFeature === index }"
                    x-bind:class="featuresVisible ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
                    :style="`transition: all 0.8s ease-out; transition-delay: ${index * 0.2}s`">
                    <div class="flex items-center gap-3 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6 text-red-500 transition-transform duration-500 group-hover:scale-110">
                            <path stroke-linecap="round" stroke-linejoin="round" :d="feature.icon" />
                        </svg>
                        <h3 class="text-xl font-bold text-white transition-colors duration-300 group-hover:text-red-500"
                            x-text="feature.title"></h3>
                    </div>
                    <p class="text-gray-400 transition-opacity duration-300 group-hover:text-gray-300"
                        x-text="feature.description"></p>
                </div>
            </template>
        </div>
        
<!-- Label Section -->
<x-label-section />

        <!-- Footer -->
        <footer class="relative pt-20 pb-10 overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute inset-0">
                <div
                    class="absolute bottom-0 w-full h-px bg-gradient-to-r from-transparent via-red-500/20 to-transparent">
                </div>
                <div
                    class="absolute w-[500px] h-[500px] -left-48 -bottom-48 rounded-full mix-blend-multiply filter blur-3xl opacity-20 bg-gradient-to-br from-red-500 to-purple-500">
                </div>
            </div>

            <div class="container relative px-4 mx-auto max-w-7xl">
                <!-- Footer Grid -->
                <div class="grid grid-cols-1 gap-12 mb-12 md:grid-cols-4">
                    <!-- Brand Column -->
                    <div class="col-span-1">
                        <img src="{{ asset('assets/hero-production-music.webp') }}" alt="Snow N Stuff Logo"
                            class="h-12 mb-4">
                        <p class="mb-4 text-gray-400">Creating powerful music for your stories since 2017</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 transition-colors duration-300 hover:text-red-500">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 transition-colors duration-300 hover:text-red-500">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 transition-colors duration-300 hover:text-red-500">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-span-1">
                        <h4 class="mb-6 font-bold text-white">Quick Links</h4>
                        <ul class="space-y-4">
                            <li><a href="#"
                                    class="text-gray-400 transition-colors duration-300 hover:text-red-500">About
                                    Us</a></li>
                            <li><a href="#"
                                    class="text-gray-400 transition-colors duration-300 hover:text-red-500">Services</a>
                            </li>
                            <li><a href="#"
                                    class="text-gray-400 transition-colors duration-300 hover:text-red-500">Music
                                    Library</a></li>
                            <li><a href="#"
                                    class="text-gray-400 transition-colors duration-300 hover:text-red-500">Licensing</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="col-span-1">
                        <h4 class="mb-6 font-bold text-white">Contact</h4>
                        <ul class="space-y-4">
                            <li class="flex items-center space-x-3 text-gray-400">
                                <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>contact@snownstuff.com</span>
                            </li>
                            <li class="flex items-center space-x-3 text-gray-400">
                                <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span>+1 (555) 123-4567</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Newsletter -->
                    <div class="col-span-1">
                        <h4 class="mb-6 font-bold text-white">Newsletter</h4>
                        <p class="mb-4 text-gray-400">Stay updated with our latest releases and music production tips.
                        </p>
                        <form class="space-y-3">
                            <div class="relative">
                                <input type="email" placeholder="Enter your email"
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
                            <a href="#"
                                class="text-sm text-gray-400 transition-colors duration-300 hover:text-red-500">Privacy
                                Policy</a>
                            <a href="#"
                                class="text-sm text-gray-400 transition-colors duration-300 hover:text-red-500">Terms
                                of Service</a>
                        </div>
                        <div class="text-sm text-gray-400">
                            Web Development by
                            <a href="https://clickstudios-digital.com" target="_blank" rel="noopener noreferrer"
                                class="text-red-500 transition-colors duration-300 hover:text-red-400">
                                Click Studios Digital
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Scroll to Top Button -->
                <button @click="window.scrollTo({top: 0, behavior: 'smooth'})" x-data="{ showButton: false }"
                    @scroll.window="showButton = (window.pageYOffset > 100)" x-show="showButton"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-2"
                    class="fixed p-2 text-white transition-all duration-300 transform bg-red-500 rounded-full shadow-lg bottom-8 right-8 hover:bg-red-600 hover:-translate-y-1">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 10l7-7m0 0l7 7m-7-7v18" />
                    </svg>
                </button>
            </div>
        </footer>

    </div>
    @livewireScripts
</body>

</html>