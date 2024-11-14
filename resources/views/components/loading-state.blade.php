<div
    x-cloak
    x-show="loading"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-sm"
>
    <div class="space-y-6 text-center">
        <div class="relative w-24 h-24">
            <div class="absolute w-full h-full border-4 border-red-500 rounded-full opacity-20 animate-ping"></div>
            <div class="absolute w-full h-full border-4 rounded-full border-t-red-500 border-r-transparent border-b-transparent border-l-transparent animate-spin"></div>
        </div>
        <div class="text-lg font-bold text-white font-roboto-condensed">
            Loading...
        </div>
    </div>
</div>