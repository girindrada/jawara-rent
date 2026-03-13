<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Office Space') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg"> 
                <form method="POST" action="{{ route('admin.office-spaces.store') }}" enctype="multipart/form-data">
                    @csrf

                    <input id="is_open" class="block mt-1 w-full" type="hidden" name="is_open" value="1" />
                    <input id="is_full_booked" class="block mt-1 w-full" type="hidden" name="is_full_booked" value="0" />
                       
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="thumbnail" :value="__('thumbnail')" />
                        <x-text-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>

                     <div class="mt-4">
                        <x-input-label for="about" :value="__('about')" />
                        <textarea name="about" id="about" cols="30" rows="5" class="border border-slate-300 rounded-xl w-full"></textarea>
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="city" :value="__('City')" />
                        
                        <select name="city_id" id="city_id" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="">-- choose city --</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>

                        <x-input-error :messages="$errors->get('city_id')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>


                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" required autofocus autocomplete="price" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="duration" :value="__('Duration')" />
                        <x-text-input id="duration" class="block mt-1 w-full" type="text" name="duration" :value="old('duration')" required autofocus autocomplete="duration" />
                        <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <hr>
                        <h2>Others</h2>
                    </div>

                    <div class="flex gap-6">
                        @for($i = 0; $i < 3; $i++)
                            <div class="mt-4">
                                <x-input-label for="benefits" :value="__('benefits ' . $i+1)" />
                                <x-text-input class="block mt-1 w-full" type="text" name="benefits[]" />
                                <x-input-error :messages="$errors->get('benefits.' . $i)" class="mt-2" />
                            </div>
                        @endfor
                    </div>

                    <x-input-label class="text-red-500 mt-4" :value="__('*notes: maximal size image 10Mb')" />
                    <div class="flex gap-6">
                        @for($i = 0; $i < 3; $i++)
                            <div class="mt-4">
                                <x-input-label for="photos" :value="__('photos ' . $i+1)" />
                                <x-text-input class="block mt-1 w-full" type="file" name="photos[]" />
                                <x-input-error :messages="$errors->get('photos.' . $i)" class="mt-2" />
                            </div>
                        @endfor
                    </div>

                    <div class="flex items-center justify-end mt-4">
            
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Add New Office Space
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>