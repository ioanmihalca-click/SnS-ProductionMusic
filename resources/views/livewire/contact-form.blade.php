<div>
    <!-- Trigger Button - rămâne neschimbat -->
    <button wire:click="$set('showModal', true)"
        class="group relative px-8 py-3 text-lg font-semibold text-white transition-all duration-300 border border-white/50 rounded-lg hover:bg-white hover:text-black hover:border-white hover:shadow-xl hover:-translate-y-0.5 backdrop-blur-sm overflow-hidden">
        <span class="relative z-10 transition-transform duration-500 group-hover:-translate-y-[120%] inline-block">
            Contact Us
        </span>
        <span class="absolute inset-0 flex items-center justify-center transition-transform duration-500 translate-y-[120%] group-hover:translate-y-0">
            Get in Touch
        </span>
    </button>

    <!-- Modal -->
    <div x-show="$wire.showModal" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" 
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" 
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" 
        class="fixed inset-0 z-50" 
        style="display: none;">
        
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity bg-black bg-opacity-75"></div>

        <!-- Modal content container -->
        <div class="fixed inset-0 flex items-center justify-center md:p-4">
            <div x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-y-4"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform translate-y-4"
                class="relative w-full h-full md:h-auto md:max-h-[90vh] md:w-[28rem] bg-gradient-to-b from-gray-900 to-black md:rounded-xl border-t md:border border-gray-800 backdrop-blur-sm overflow-auto md:overflow-visible">
                
                <!-- Scroll container for content -->
                <div class="h-full p-6 md:h-auto md:overflow-y-auto">
                    <!-- Close button -->
                    <button wire:click="$set('showModal', false)"
                        class="absolute p-2 transition-colors duration-200 rounded-full top-4 right-4 hover:bg-gray-800">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <!-- Form header -->
                    <div class="mb-6 text-center">
                        <h3 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-purple-500">
                            Get in Touch
                        </h3>
                        <p class="mt-2 text-gray-400">We'll get back to you as soon as possible.</p>
                    </div>


                <!-- Form -->
                <form wire:submit.prevent="submit" class="space-y-4">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-400">Name</label>
                        <input wire:model="name" type="text" id="name"
                            class="w-full px-4 py-2 text-white placeholder-gray-500 border border-gray-800 rounded-lg bg-black/50 focus:ring-red-500 focus:border-red-500"
                            placeholder="Your name">
                        @error('name')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-400">Email</label>
                        <input wire:model="email" type="email" id="email"
                            class="w-full px-4 py-2 text-white placeholder-gray-500 border border-gray-800 rounded-lg bg-black/50 focus:ring-red-500 focus:border-red-500"
                            placeholder="your@email.com">
                        @error('email')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Message -->
                    <div>
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-400">Message</label>
                        <textarea wire:model="message" id="message" rows="4"
                            class="w-full px-4 py-2 text-white placeholder-gray-500 border border-gray-800 rounded-lg bg-black/50 focus:ring-red-500 focus:border-red-500"
                            placeholder="Your message..."></textarea>
                        @error('message')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit button -->
                    <button type="submit"
                        class="w-full h-12 px-6 text-white transition-all duration-300 bg-gradient-to-r from-red-600 to-red-800 rounded-lg hover:shadow-xl hover:shadow-red-900/20 hover:-translate-y-0.5 relative"
                        wire:loading.class="cursor-wait">
                        <span wire:loading.remove>
                            Send Message
                        </span>

                        <span wire:loading class="absolute -translate-x-1/2 -translate-y-1/2 left-1/2 top-1/2">
                            <svg class="w-5 h-5 text-white animate-spin" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </span>
                    </button>

                </form>

                <!-- Success message -->
                @if (session()->has('message'))
                    <div class="mt-4 text-sm font-medium text-center text-green-500">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
