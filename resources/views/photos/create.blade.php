<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Photos List') }}
        </h2>
        <a href="{{ route('photos.create') }}"><button class="rounded-full py-2 px-3 mt-2 uppercase text-xs font-black font-white cursor-pointer bg-green-500">Upload New Photo</button></a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <div class="mt-8 grid lg:grid-cols-4 gap-10">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>