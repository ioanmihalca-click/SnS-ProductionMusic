  <!--Company Logos-->
<div class="py-16 overflow-hidden bg-gradient-to-t from-transparent via-black to-transparent backdrop-blur-sm">
    <div class="container px-4 mx-auto max-w-7xl">
        <h2 class="mb-12 text-2xl font-bold text-center text-white md:text-3xl font-roboto-condensed">
            We provided music for
        </h2>

        <div class="relative flex"
             x-data="{ isPaused: false }"
             @mouseenter="$refs.logoContainer.style.animationPlayState = 'paused'"
             @mouseleave="$refs.logoContainer.style.animationPlayState = 'running'">
            
            <!-- Primary logos -->
            <div x-ref="logoContainer"
                 class="flex animate-scroll">
                <div class="flex flex-none md:gap-8">
                    <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                       <img src="{{ asset('assets/company-logos/canal-plus.jpg') }}" alt="Bloomberg Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                    <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/bloomberg.jpg') }}" alt="Bloomberg Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                    <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/cbs-sports.jpg') }}" alt="CBS Sports Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                    <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/ITV.jpg') }}" alt="ITV Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                    <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/pbs.jpg') }}" alt="PBS Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                    <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/discovery.jpg') }}" alt="Discovery Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                      <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/universal.jpg') }}" alt="Universal Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                      <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/cbs.jpg') }}" alt="CBS Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                      <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/sonymusic.jpg') }}" alt="Sony Music Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                      <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/telemundo.jpg') }}" alt="Telemundo Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                      <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/warnermusic.jpg') }}" alt="Warner Music Logo " class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                      <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/ultramusic.jpg') }}" alt="UltraMusic Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                      <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/fiaworldrally.jpg') }}" alt="FIA World Rally Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                </div>

                <!-- Duplicated logos for seamless loop -->
                <div class="flex flex-none gap-8">
                    <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                       <img src="{{ asset('assets/company-logos/canal-plus.jpg') }}" alt="Bloomberg Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                    <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/bloomberg.jpg') }}" alt="Bloomberg Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                    <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/cbs-sports.jpg') }}" alt="CBS Sports Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                    <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/ITV.jpg') }}" alt="ITV Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                    <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/pbs.jpg') }}" alt="PBS Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                    <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/discovery.jpg') }}" alt="Discovery Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                      <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/universal.jpg') }}" alt="Universal Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                      <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/cbs.jpg') }}" alt="CBS Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                      <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/sonymusic.jpg') }}" alt="Sony Music Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                      <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/telemundo.jpg') }}" alt="Telemundo Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                      <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/warnermusic.jpg') }}" alt="Warner Music Logo " class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                      <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/ultramusic.jpg') }}" alt="UltraMusic Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                      <div class="flex items-center justify-center w-[200px] h-24 p-8 transition-all duration-300 bg-black/30 rounded-xl hover:bg-black/40">
                        <img src="{{ asset('assets/company-logos/fiaworldrally.jpg') }}" alt="FIA World Rally Logo" class="object-contain transition-opacity duration-300 opacity-70 hover:opacity-100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>