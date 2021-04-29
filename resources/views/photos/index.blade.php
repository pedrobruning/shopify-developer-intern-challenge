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
                        @foreach($photos as $photo)
                            <div class="bg-white rounded overflow-hidden shadow-md relative">
                                <img src="{{ $photo->path }}" class="w-full h-32 sm:h-48 object-cover lg:hover:h-23" />
                                <div class="m-4">
                                    <span class="font-bold">{{ $photo->title }}</span>
                                    <span class="block">Price: $ {{ number_format(($photo->price - $photo->discount) / 100, 2) }}</span>
                                    <span class="block text-gray-500 text-sm">Photo By: {{ $photo->user->name }}</span>
                                </div>
                                @if($photo->discount > 0)
                                    <div style="background-color: red" class="text-black text-xs uppercase font-bold rounded-full p-2 absolute top-0 ml-2 mt-2">
                                        <span>
                                            {{ $photo->discount_percentage }}% OFF!
                                        </span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $photos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>