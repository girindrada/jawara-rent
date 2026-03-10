<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                <form method="POST" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="flex gap-3 mt-4">
                        <div class="flex-1">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full disabled:bg-gray-200 disabled:text-gray-500" type="text" name="name" value="{{ $user->name }}" disabled />
                        </div>
                        <div class="flex-1">
                            <x-input-label for="email" :value="__('email')" />
                            <x-text-input id="email" class="block mt-1 w-full disabled:bg-gray-200 disabled:text-gray-500" type="text" name="email" value="{{ $user->email }}" disabled />
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="status" :value="__('Status')" />

                        <select name="status" id="status"
                            class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="">-- Choose Status --</option>
                            <option value="admin" {{ old('status', $user->status) == 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>

                            <option value="user" {{ old('status', $user->status) == 'user' ? 'selected' : '' }}>
                                User
                            </option>
                        </select>

                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="is_active" :value="__('is Active')" />

                        <select name="is_active" id="is_active"
                            class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="">-- Select Option --</option>
                            <option value="1" {{ old('is_active', $user->is_active) == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0" {{ old('is_active', $user->is_active) == 0 ? 'selected' : '' }}>
                                Pending
                            </option>
                        </select>

                        <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                    </div>


                    <div class="flex items-center justify-end mt-4">

                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update user
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
