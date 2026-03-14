<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Booking Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('admin.booking-transactions.store') }}">
                    @csrf

                    <div>
                        <x-input-label for="booking_trx_id" :value="__('Booking trx id')" />
                        <x-text-input id="booking_trx_id" class="block mt-1 w-full" type="text" name="booking_trx_id"
                            :value="old('booking_trx_id')" autofocus autocomplete="booking_trx_id" />
                        <x-input-error :messages="$errors->get('booking_trx_id')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="phone_number" :value="__('Phone')" />
                        <x-text-input id="phone_number" class="block mt-1 w-full" type="tel" name="phone_number"
                            :value="old('phone_number')" required autofocus autocomplete="phone_number" />
                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="office_space" :value="__('office Space')" />

                        <select name="office_space_id" id="office_space_id"
                            class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="">-- choose office space --</option>
                            @foreach ($officeSpaces as $officeSpace)
                                <option value="{{ $officeSpace->id }}">{{ $officeSpace->name }}</option>
                            @endforeach
                        </select>

                        <x-input-error :messages="$errors->get('officeSpace_id')" class="mt-2" />
                    </div>


                    <div class="mt-4">
                        <x-input-label for="total_amount" :value="__('Total Amount')" />
                        <x-text-input id="total_amount" class="block mt-1 w-full" type="number" name="total_amount"
                            :value="old('total_amount')" required autofocus autocomplete="total_amount" />
                        <x-input-error :messages="$errors->get('total_amount')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="ended_at" :value="__('Duration')" />
                        <x-text-input id="duration" class="block mt-1 w-full" type="text" name="duration"
                            :value="old('duration')" required autofocus autocomplete="duration" />
                        <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="started_at" :value="__('started_at')" />
                        <x-text-input id="started_at" class="block mt-1 w-full" type="date" name="started_at"
                            :value="old('started_at')" required autofocus autocomplete="started_at" />
                        <x-input-error :messages="$errors->get('started_at')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="ended_at" :value="__('ended_at')" />
                        <x-text-input id="ended_at" class="block mt-1 w-full" type="date" name="ended_at"
                            :value="old('ended_at')" required autofocus autocomplete="ended_at" />
                        <x-input-error :messages="$errors->get('ended_at')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="is_paid" :value="__('Is Paid')" />

                        <select name="is_paid" id="is_paid"
                            class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="">-- choose --</option>
                            <option value="1">Paid</option>
                            <option value="0">Not Paid</option>
                        </select>

                        <x-input-error :messages="$errors->get('is_paid')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">

                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Add New Booking Transaction
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
