<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage User') }}
            </h2>
        </div>
    </x-slot>

    <div class="pt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
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
                            <th class="p-4">Email</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Is Active?</th>
                            <th class="p-4">Join At</th>
                            <th class="p-4">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-4">
                                    {{ $user->name }}
                                </td>
                                <td class="p-4">
                                    {{ $user->email }}
                                </td>
                                <td class="p-4">
                                    {{ $user->status }}
                                </td>
                                <td class="p-4">
                                    {{ $user->is_active == true ? 'Active' : 'Pending' }}
                                </td>
                                <td class="p-4">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>

                                @if ($user->email != 'admin@gmail.com')
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">

                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">
                                                Edit
                                            </a>

                                        </div>
                                    </td>
                                @else
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <button disabled
                                                class="px-4 py-2 bg-gray-300 text-gray-500 text-sm font-semibold rounded-lg cursor-not-allowed">
                                                Edit
                                            </button>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-slate-500">
                                    <p>Belum ada data user</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-6 bg-white p-4 rounded-lg">
                    {{ $users->links('pagination::simple-tailwind') }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
