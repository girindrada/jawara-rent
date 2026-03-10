<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage City') }}
            </h2>
            <a href="{{ route('admin.cities.create') }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="pt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
        </div>
    </div>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-50 text-left">
                            <th class="p-4">Name</th>
                            <th class="p-4">Photo</th>
                            <th class="p-4">Created</th>
                            <th class="p-4">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($cities as $city)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4">
                                {{ $city->name }}
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <img 
                                        src="{{ Storage::url($city->photo) }}"
                                        class="w-[80px] h-[60px] object-cover rounded-lg"
                                    >
                                </div>
                            </td>
                            <td class="p-4">
                                {{ $city->created_at->format('M D, Y') }}
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    
                                    <a href="{{ route('admin.cities.edit', $city) }}"
                                    class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.cities.destroy', $city) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this city?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700 transition">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-slate-500">
                                    <p>Belum ada data city</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-6 bg-white p-4 rounded-lg">
                    {{ $cities->links('pagination::simple-tailwind') }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>