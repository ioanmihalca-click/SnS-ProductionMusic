<!-- Label Section -->
<section class="relative min-h-screen py-24 overflow-hidden " 
         x-data="{ showLabel: false }" 
         x-intersect="showLabel = true">
    <!-- Background Layers -->
    <div class="absolute inset-0">
        <!-- Primary Gradient Orbs -->
        <div class="absolute w-[800px] h-[800px] -right-96 top-0 rounded-full 
                    mix-blend-soft-light filter blur-3xl opacity-30 
                    bg-gradient-to-br from-red-500 via-red-600 to-transparent 
                    animate-pulse">
        </div>
        <div class="absolute w-[600px] h-[600px] -left-72 bottom-0 rounded-full 
                    mix-blend-soft-light filter blur-3xl opacity-30 
                    bg-gradient-to-tr from-red-800 via-red-600 to-transparent 
                    animate-pulse" 
             style="animation-delay: 2s">
        </div>
            
    </div>

    <!-- Main Content Container -->
    <div class="container relative px-4 mx-auto max-w-7xl">
        <!-- Enhanced Header Section -->
        <div class="relative z-10 max-w-3xl mx-auto mb-20 text-center">
            <!-- Presentational Badge -->
            <div class="inline-block px-6 py-2 mb-8 border rounded-full bg-black/80 border-red-500/20 backdrop-blur-sm">
                <span class="text-sm font-medium tracking-wide uppercase text-red-400/90">
                    Snow N Stuff presents
                </span>
            </div>
            
            <!-- Main Title with enhanced gradient -->
            <h2 class="mb-6 text-5xl font-bold tracking-tight text-transparent font-roboto-condensed bg-clip-text bg-gradient-to-r from-white via-pink-100 to-white animate-gradient md:text-6xl">
                Discover Our Music Label
            </h2>

            <!-- Subtitle with enhanced visibility -->
            <p class="text-xl text-gray-400/90 md:text-2xl">
                Where Production Music Meets Artistic Expression
            </p>
        </div>

        <!-- Two-Column Content Layout -->
        <div class="grid items-center grid-cols-1 gap-20 md:grid-cols-2">
            <!-- Left Column - Image -->
            <div class="relative"
                 x-show="showLabel"
                 x-transition:enter="transition ease-out duration-700 delay-200"
                 x-transition:enter-start="opacity-0 transform translate-x-4"
                 x-transition:enter-end="opacity-100 transform translate-x-0">
                
                <!-- Image Container -->
                <div class="relative group">
                
                    <!-- Image Wrapper -->
                    <div class="relative p-1">
                        <div class="relative rounded-xl backdrop-blur-sm">
                            <div class="absolute inset-0 transition-opacity duration-500 bg-gradient-to-tr from-red-500/10 via-transparent to-red-500/10 group-hover:opacity-75">
                            </div>
                            <img src="{{ asset('assets/logo-sns.png') }}" 
                                 alt="Snow N Stuff Music Label" 
                                 class="relative z-10 object-cover w-full transition-transform duration-500 group-hover:scale-105">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Content -->
            <div class="space-y-10"
                 x-show="showLabel"
                 x-transition:enter="transition ease-out duration-700 delay-400"
                 x-transition:enter-start="opacity-0 transform translate-x-4"
                 x-transition:enter-end="opacity-100 transform translate-x-0">
                
                <!-- Text Content -->
                <div class="space-y-6">
                    <h3 class="text-3xl font-bold text-transparent font-roboto-condensed bg-clip-text bg-gradient-to-r from-red-500 to-red-300">
                        More Than Production Music
                    </h3>
                    <p class="text-lg leading-relaxed text-gray-300">
                        Experience the artistic side of Snow N Stuff through our record label. 
                        We work with talented artists to create unique musical experiences 
                        that go beyond production music.
                    </p>
                </div>
                
                <!-- Features List -->
                <div class="space-y-4">
                    <!-- Feature 1 -->
                    <div class="p-4 transition-all duration-300 border bg-gradient-to-r from-red-500/5 via-red-500/10 to-red-500/5 border-red-500/10 rounded-xl hover:border-red-500/30 group hover:translate-x-1">
                        <div class="flex items-center space-x-4">
                            <span class="flex-shrink-0 p-2 rounded-lg bg-gradient-to-br from-red-500/20 to-transparent">
                                <svg class="w-6 h-6 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" 
                                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="text-lg font-medium text-white transition-colors duration-300 group-hover:text-red-400">
                                Original Artist Releases
                            </span>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-4 transition-all duration-300 border bg-gradient-to-r from-red-500/5 via-red-500/10 to-red-500/5 border-red-500/10 rounded-xl hover:border-red-500/30 group hover:translate-x-1">
                        <div class="flex items-center space-x-4">
                            <span class="flex-shrink-0 p-2 rounded-lg bg-gradient-to-br from-red-500/20 to-transparent">
                                <svg class="w-6 h-6 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" 
                                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="text-lg font-medium text-white transition-colors duration-300 group-hover:text-red-400">
                                Exclusive Music Collections
                            </span>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-4 transition-all duration-300 border bg-gradient-to-r from-red-500/5 via-red-500/10 to-red-500/5 border-red-500/10 rounded-xl hover:border-red-500/30 group hover:translate-x-1">
                        <div class="flex items-center space-x-4">
                            <span class="flex-shrink-0 p-2 rounded-lg bg-gradient-to-br from-red-500/20 to-transparent">
                                <svg class="w-6 h-6 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" 
                                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="text-lg font-medium text-white transition-colors duration-300 group-hover:text-red-400">
                                Artist Collaborations
                            </span>
                        </div>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="pt-6">
                    <a href="/label" 
                       class="group relative font-roboto-condensed inline-flex items-center px-8 py-4 
                              text-lg font-semibold text-white transition-all duration-500 
                              bg-gradient-to-r from-red-700 via-red-600 to-red-700 rounded-xl 
                              hover:shadow-xl hover:shadow-red-500/20 hover:-translate-y-0.5">
                        <span class="relative z-10">Visit Label</span>
                        <svg class="relative z-10 w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1" 
                             xmlns="http://www.w3.org/2000/svg" 
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                  stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                        <div class="absolute inset-0 w-full h-full transition-all duration-300 opacity-0 rounded-xl group-hover:opacity-100 bg-gradient-to-r from-red-600 via-red-500 to-red-600">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

