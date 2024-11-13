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
        ]
    }" x-init="setTimeout(() => showContent = true, 100);
    window.addEventListener('scroll', () => {
        scrollPosition = window.pageYOffset;
    });">

        <!-- Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute rounded-full w-96 h-96 blur-3xl -top-48 -left-48 bg-red-900/50"
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
            <div class="relative mb-8 transform rounded-2xl"
                x-bind:class="showContent ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
                style="transition: all 0.8s ease-out">
                <div class="absolute inset-0 bg-gradient-to-b from-black/0 to-black/20 rounded-2xl"></div>
                <img src="{{ asset('assets/hero-production-music.webp') }}" alt="Snow N Stuff Production Music"
                    class="mx-auto transition-all duration-700 shadow-2xl w-96 hover:scale-105 rounded-2xl hover:shadow-red-900/20"
                    x-bind:style="'transform: translateY(' + scrollPosition * 0.1 + 'px)'">
            </div>

            <!-- Introduction Text -->
            <div class="max-w-xl p-6 text-base text-center text-gray-300 transform border shadow-xl font-roboto-condensed bg-black/20 rounded-2xl border-gray-800/50"
                x-bind:class="showContent ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
                style="transition: all 0.8s ease-out; transition-delay: 0.2s">

                <!-- Titlu cu efect de typing -->
                <h1 class="mb-6 text-3xl font-bold text-white" x-data="{ text: 'Captivate, Inspire and Elevate your Story', currentText: '' }" x-init="await new Promise(resolve => setTimeout(resolve, 800));
                for (let i = 0; i <= text.length; i++) {
                    await new Promise(resolve => setTimeout(resolve, 30));
                    currentText = text.substring(0, i);
                }"
                    x-text="currentText">
                </h1>

                <!-- Primul paragraf -->
                <p class="mb-4 transition-all duration-1000 transform"
                    x-bind:class="showContent ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
                    style="transition-delay: 1.2s">
                    Introducing Snow N Stuff Production Music - your ultimate source for exclusive,
                    emotion-driven sound. We're a boutique production music library, specializing in
                    crafting powerful music for any project - from gripping TV series and cinematic
                    trailers to high-impact advertisements.
                </p>

                <!-- Al doilea paragraf -->
                <p class="mb-4 transition-all duration-1000 transform"
                    x-bind:class="showContent ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
                    style="transition-delay: 1.5s">
                    Our collection is far from ordinary; we go beyond the standard genres, offering
                    unique sounds that elevate your vision and leave a lasting impact. Plus, we offer
                    custom music and expert sound design tailored to your needs, with licensing options
                    that are as flexible as they are impressive.
                </p>

                <!-- Al treilea paragraf -->
                <p class="font-semibold text-white transition-all duration-1000 transform"
                    x-bind:class="showContent ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
                    style="transition-delay: 1.8s">
                    Choose Snow N Stuff - where every note is crafted to captivate, inspire and
                    elevate your story.
                </p>
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

        <!-- Footer -->
        <footer
            class="px-2 py-8 text-center text-gray-500 transform border-t border-gray-800/50 backdrop-blur-sm bg-black/20"
            x-bind:class="showContent ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
            style="transition: all 0.8s ease-out; transition-delay: 1.2s">
            <p>&copy; 2024 Snow N Stuff Production Music. All rights reserved.</p>
        </footer>
    </div>
    @livewireScripts
</body>

</html>
