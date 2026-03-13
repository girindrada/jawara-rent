<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Office Space') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg"> 
                <form method="POST" action="{{ route('admin.office-spaces.update', $officeSpace) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $officeSpace->name)" autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="thumbnail" :value="__('thumbnail')" />
                        <div class="flex gap-3">
                            <img src="{{ Storage::url($officeSpace->thumbnail) }}" alt="thumbnail" class="rounded-2xl object-cover w-[120px] h-[90px]">
                            <x-text-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail"  autofocus autocomplete="thumbnail" />
                        </div>
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>

                     <div class="mt-4">
                        <x-input-label for="about" :value="__('about')" />
                        <textarea name="about" id="about" cols="30" rows="5" class="border border-slate-300 rounded-xl w-full">{{ $officeSpace->about }}</textarea>
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="city" :value="__('City')" />
                        
                        <select name="city_id" id="city_id" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="">-- choose city --</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}"
                                    @selected(old('city_id', $officeSpace->city->id == $city->id))>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>

                        <x-input-error :messages="$errors->get('city_id')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $officeSpace->address)" required autofocus autocomplete="address" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>


                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price', $officeSpace->price)" required autofocus autocomplete="price" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="duration" :value="__('Duration')" />
                        <x-text-input id="duration" class="block mt-1 w-full" type="text" name="duration" :value="old('duration', $officeSpace->duration)" required autofocus autocomplete="duration" />
                        <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="is_open" :value="__('Is Open')" />

                        <select name="is_open" id="is_open" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="1" {{ old('is_open', $officeSpace->is_open) == 1 ? 'selected' : '' }}>Open</option>
                            <option value="0" {{ old('is_open', $officeSpace->is_open) == 0 ? 'selected' : '' }}>Closed</option>
                         </select>

                        <x-input-error :messages="$errors->get('is_open')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="is_full_booked" :value="__('Is Full Booked')" />

                        <select name="is_full_booked" id="is_full_booked" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="1" {{ old('is_full_booked', $officeSpace->is_full_booked) == 1 ? 'selected' : '' }}>Available</option>
                            <option value="0" {{ old('is_full_booked', $officeSpace->is_full_booked) == 0 ? 'selected' : '' }}>Full Booked</option>
                        </select>

                        <x-input-error :messages="$errors->get('is_full_booked')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <hr>
                        <h2>Others</h2>
                    </div>

                    @php
                    $benefits = old('benefits', $officeSpace->officeSpaceBenefits->pluck('name')->toArray());
                    @endphp

                    <div class="flex gap-6">
                        @for($i = 0; $i < 3; $i++)
                            <div class="mt-4">
                                <x-input-label :value="__('benefits ' . ($i+1))" />

                                <x-text-input 
                                    class="block mt-1 w-full" 
                                    type="text" 
                                    name="benefits[]" 
                                    :value="$benefits[$i] ?? ''"
                                />

                                <x-input-error :messages="$errors->get('benefits.' . $i)" class="mt-2" />
                            </div>
                        @endfor
                    </div>

                    @php
                    $photos = $officeSpace->officeSpacePhotos;
                    @endphp

                    <x-input-label class="text-red-500 mt-4" :value="__('*notes: maximal size image 10Mb')" />
                    <div class="flex gap-6">
                        @foreach($photos as $i => $photo)
                            <div class="mt-4">
                                <x-input-label :value="__('Photo ' . ($i+1))" />
                                <img src="{{ Storage::url($photo->photo) }}"
                                    class="w-32 h-24 object-cover rounded-lg mb-2">

                                <input
                                    type="file"
                                    name="photos[]"
                                    class="block mt-1 w-full"
                                />

                                <x-input-error :messages="$errors->get('photos.' . $i)" class="mt-2" />
                            </div>
                        @endforeach
                    </div>

                    <div class="flex items-center justify-end mt-4">
            
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update New Office Space
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>