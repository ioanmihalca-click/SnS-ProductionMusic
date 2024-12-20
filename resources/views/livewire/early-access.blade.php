
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
                    class="w-48 mx-auto transition-all duration-700 shadow-2xl hover:scale-105 rounded-2xl hover:shadow-red-900/20"
                    x-bind:style="'transform: translateY(' + scrollPosition * 0.1 + 'px)'">

                <!-- Floating badges -->
                <div class="absolute top-0 px-4 py-2 -mt-4 -mr-4 text-sm font-semibold text-white transform rounded-lg shadow-lg right-1 rotate-2 bg-gradient-to-r from-red-600 to-red-700">
            Early Access
        </div> 
                {{-- <div class="absolute bottom-0 left-0 px-4 py-2 -mb-4 -ml-4 text-sm font-semibold text-white transform rounded-lg shadow-lg -rotate-2 bg-gradient-to-r from-purple-600 to-purple-700">
            Exclusive Content
        </div> --}}
            </div>
            {{-- <!-- Introduction Text -->
            <div class="max-w-2xl p-8 text-center transform border shadow-xl font-roboto-condensed bg-black/20 rounded-2xl border-gray-800/50"
                x-bind:class="showContent ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
                style="transition: all 0.8s ease-out; transition-delay: 0.2s">

                <!-- Main Headline -->
                <h1 class="mb-4">
                    <span
                        class="block text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-purple-500"
                        x-ref="typingText" data-text="Premium Production Music Library">
                    </span>
                    <span class="text-xl font-medium text-gray-400">Elevate Your Content with Professional Sound</span>
                </h1>

                <!-- Value Propositions -->
                <div class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-2">
                    <div
                        class="p-4 transition-all duration-300 border border-gray-800 rounded-lg hover:border-red-500/50 hover:bg-red-500/5">
                        <h3 class="mb-2 text-lg font-semibold text-white">Exclusive Library</h3>
                        <p class="text-sm text-gray-400">Unique, high-quality tracks crafted for professional
                            productions</p>
                    </div>
                    <div
                        class="p-4 transition-all duration-300 border border-gray-800 rounded-lg hover:border-red-500/50 hover:bg-red-500/5">
                        <h3 class="mb-2 text-lg font-semibold text-white">Custom Solutions</h3>
                        <p class="text-sm text-gray-400">Tailored music creation for your specific project needs</p>
                    </div>
                </div>

                <!-- Trust Indicators -->
                <div class="flex flex-wrap items-center justify-center gap-6 mt-8">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="text-sm font-medium text-gray-400">Trusted since 2017</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-medium text-gray-400">100% Original Content</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <span class="text-sm font-medium text-gray-400">Fast Delivery</span>
                    </div>
                </div>
            </div> --}}

            <div class="w-full px-4">
                <livewire:album-player />
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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor"
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




