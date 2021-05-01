<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Sales') }}
        </h2>
        <a href="{{ route('photos.create') }}">
            <button
                    class="rounded-full py-2 px-3 mt-2 uppercase text-xs font-black text-white cursor-pointer bg-green-500">
                Upload New Photo
            </button>
        </a>
        @if ($errors->any())
            <div role="alert" class="mt-2">
                <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                    Danger
                </div>
                <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                    <ul>
                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <div class="mt-8">
                        @forelse($sales as $sale)
                            <div class="bg-white rounded mt-3 overflow-hidden shadow-md relative">
                                <img src="{{ $sale->photo->path }}" class="w-full h-32 sm:h-48 object-cover lg:hover:h-23" />
                                <div class="m-4">
                                    <span class="font-bold">{{ $sale->photo->title }}</span>
                                    <span class="block">Price: $ {{ number_format($sale->total /100, 2) }}</span>
                                    <span class="block text-gray-500 text-sm">Bought By: {{ $sale->buyer->name }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white uppercase font-bold rounded text-center overflow-hidden shadow-md relative">
                                <h1>There is no Sale</h1>
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        {{ $sales->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>