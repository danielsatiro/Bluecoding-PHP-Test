<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ $action }}">
                    @if (isset($method) && $method == 'PUT')
                        @method('PUT')
                    @endif
                    @csrf

                    <input type="hidden" name="id" :value="old('id', $shortUrl->id ?? '')">

                    <!-- URL Address -->
                    <div>
                        <x-label for="url" :value="__('URL Address')" />

                        <x-input id="url" class="block mt-1 w-full" type="url" name="url" :value="old('url', $shortUrl->url ?? '')"  placeholder="https://long-url.com" required autofocus />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button>
                            {{ __($buttonTitle) }}
                        </x-button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
