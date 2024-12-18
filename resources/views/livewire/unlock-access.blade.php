<div class="max-w-2xl px-4 py-12 mx-auto">
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-300">Unlock Early Access</h1>
        {{-- <p class="mt-2 text-gray-300">Enter your digital key to access exclusive content</p> --}}
    </div>

    <form wire:submit="verifyKey" class="max-w-sm mx-auto space-y-6">
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-500">Digital Key</label>
            <input type="text" 
                   wire:model="accessKey" 
                   class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Ex: EARLY-ACCESS-01"
                   required
                   autofocus>
        </div>

        @if($error)
            <div class="px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded">
                {{ $error }}
            </div>
        @endif

        <button type="submit" 
                class="w-full px-4 py-2 text-white transition-colors bg-gray-700 rounded-md hover:bg-gray-800">
            Unlock Access
        </button>
    </form>
</div>