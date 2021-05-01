<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Photo') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <div>
                        <div class="md:grid md:grid-cols-1 md:gap-6">
                            <div class="mt-5 md:mt-0">
                                <form action="{{ route('photos.update', $photo) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                            <div class="block">
                                                <span class="text-gray-700">Photo Visibility</span>
                                                <div class="mt-2">
                                                    <div>
                                                        <label class="inline-flex items-center">
                                                            <input type="radio" class="form-radio" id="private"
                                                                   name="private" value="1"
                                                                   @if($photo->private == 1)
                                                                        checked
                                                                   @endif>
                                                            <span class="ml-2">Private</span>
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <label class="inline-flex items-center">
                                                            <input type="radio" class="form-radio" id="private"
                                                                   name="private" value="0"
                                                                   @if($photo->private == 0)
                                                                        checked
                                                                   @endif>
                                                            <span class="ml-2">Public</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div>
                                                    <label for="title" class="block text-sm font-medium text-gray-700">
                                                        Title <span class="text-sm text-red-500">*</span>
                                                    </label>
                                                    <div class="mt-1 flex rounded-md shadow-sm">
                                                        <input type="text" value="{{ $photo->title }}" name="title" id="title"
                                                               class="focus:ring-indigo-500 focus:border-indigo-500
                                                               flex-1 block w-full rounded-none rounded-r-md sm:text-sm
                                                               border-gray-300"
                                                               placeholder="Your photo's title comes here!" required>
                                                        @error('title')
                                                            <span class="block text-sm text-red-700">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <label for="description" class="block text-sm font-medium text-gray-700">
                                                    Description <span class="text-sm text-red-500">*</span>
                                                </label>
                                                <div class="mt-1">
                                                    <textarea id="description"  name="description" rows="3"
                                                              class="shadow-sm focus:ring-indigo-500 w-full
                                                                focus:border-indigo-500 mt-1 block sm:text-sm
                                                                border-gray-300 rounded-md"
                                                              placeholder="Your photo's description comes here!"
                                                              required>{{ $photo->description }}
                                                    </textarea>
                                                    @error('description')
                                                    <span class="block text-sm text-red-700">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">
                                                    Price <span class="text-sm text-red-500">*</span>
                                                </label>
                                                <div class="mt-1">
                                                    <input type="text" name="price" id="price"
                                                           class="focus:ring-indigo-500 focus:border-indigo-500 flex-1
                                                               block w-full rounded-none rounded-r-md sm:text-sm
                                                               border-gray-300"
                                                           value="{{ number_format($photo->price / 100, 2,',', '.') }}"
                                                           placeholder="Your photo's price comes here!" required>
                                                    @error('price')
                                                        <span class="block text-sm text-red-700">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">
                                                    Discount
                                                    <span class="block text-sm text-gray-400">
                                                        (Leave this empty if you don't want to give a discount)
                                                    </span>
                                                </label>
                                                <div class="mt-1">
                                                    <input type="text" value="{{ number_format($photo->discount / 100, 2,',', '.') }}" name="discount" id="discount"
                                                           class="focus:ring-indigo-500 focus:border-indigo-500 flex-1
                                                               block w-full rounded-none rounded-r-md sm:text-sm
                                                               border-gray-300"
                                                           placeholder="Your photo's discount comes here!">
                                                    @error('discount')
                                                        <span class="block text-sm text-red-700">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">
                                                    Photo <span class="text-sm text-red-500">*</span>
                                                    <span id="uploaded_photo" class="block text-sm text-gray-400">
                                                        Uploaded Photo: {{ $photo->original_name }}
                                                    </span>
                                                </label>
                                                <div class="mt-1">
                                                    <input type="file" onchange="$('#uploaded_photo')
                                                        .html('Uploaded Photo: ' + $('#file').val().split('fakepath\\')[1])"
                                                           name="file" id="file">
                                                    @error('file')
                                                        <span class="block text-sm text-red-700">{{ $message }}</span>
                                                    @enderror
                                                    <input type="hidden" name="path" value="{{ $photo->path }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                            <button type="submit"
                                                    class="inline-flex justify-center py-2 px-4 border
                                                    border-transparent shadow-sm text-sm font-medium rounded-md
                                                    text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none
                                                    focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @can('delete-photo', $photo)
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-md sm:overflow-hidden">
                                    <form action="{{ route('photos.destroy', $photo) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure ?')"
                                                class="inline-flex justify-center py-2 px-4 border
                                                    border-transparent shadow-sm text-sm font-medium rounded-md
                                                    text-white bg-red-600 hover:bg-red-700 focus:outline-none
                                                    focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Delete the Photo
                                        </button>
                                    </form>
                                </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script language="JavaScript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/jquery.inputmask.js') }}"></script>
    <script>
        const valueInputMask = new Inputmask('decimal', {
            'alias': 'numeric',
            'groupSeparator': '.',
            'digits': 2,
            'radixPoint': ",",
            'allowMinus': false,
            'placeholder': ''
        });

        $(document).ready(function(){
            let priceInput = document.getElementById("price");
            let discountInput = document.getElementById("discount");
            valueInputMask.mask(priceInput);
            valueInputMask.mask(discountInput);
        });


    </script>
</x-app-layout>