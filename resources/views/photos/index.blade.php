<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $page }}
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
                    <div class="mt-8 grid lg:grid-cols-4 gap-10">
                        @forelse($photos as $photo)
                            <div class="bg-white rounded overflow-hidden shadow-md relative">
                                <img src="{{ $photo->path }}" class="w-full h-32 sm:h-48 object-cover lg:hover:h-23" />
                                <div class="m-4">
                                    <span class="font-bold">{{ $photo->title }}</span>
                                    <span class="block">Price: $ {{ $photo->total_price }}</span>
                                    <span class="block text-gray-500 text-sm">Photo By: {{ $photo->artist->name }}</span>
                                </div>
                                @if(!$photo->bought)
                                    @if($photo->discount > 0)
                                        <div style="background-color: red" class="text-black text-xs uppercase font-bold rounded-full p-2 absolute top-0 ml-2 mt-2">
                                            <span>
                                                {{ $photo->discount_percentage }}% OFF!
                                            </span>
                                        </div>
                                    @endif
                                    @can('manage-photo', $photo)
                                        <a href="{{ route('photos.edit', $photo) }}">
                                            <div style="background-color: yellow" class="text-black text-xs uppercase font-bold
                                            rounded-full p-2 cursor-pointer absolute right-0 top-0 mr-2 mt-2">
                                                <span>
                                                    Edit
                                                </span>
                                            </div>
                                        </a>
                                    @else
                                        <a href="{{ route('photos.buy', $photo) }}" onclick="return confirm('Are you sure?')">
                                            <div style="background-color: green" class="text-white text-xs uppercase font-bold
                                                rounded-full p-2 cursor-pointer absolute right-0 top-0 mr-2 mt-2">
                                                    <span>
                                                        Buy
                                                    </span>
                                            </div>
                                        </a>
                                    @endcan
                                @elseif($photo->bought === 1 && $photo->private === 1)
                                    <div style="background-color: blue" class="text-white text-xs uppercase font-bold
                                    rounded-full p-2 absolute right-0 top-0 mr-2 mt-2">
                                        <span>
                                            Bought
                                        </span>
                                    </div>
                                @else
                                    <div style="background-color: red" class="text-white text-xs uppercase font-bold
                                    rounded-full p-2 absolute right-0 top-0 mr-2 mt-2">
                                        <span>
                                            Not for sale!
                                        </span>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="bg-white uppercase font-bold rounded overflow-hidden shadow-md relative">
                                <h1>Your Photo inventory is empty! Buy or Upload a new Photo!</h1>
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        {{ $photos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>