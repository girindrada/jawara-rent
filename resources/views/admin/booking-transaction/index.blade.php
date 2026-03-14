<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Transactions') }}
            </h2>
            <a href="{{ route('admin.booking-transactions.create') }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
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
                            <th class="p-4">Booking Trx Id</th>
                            <th class="p-4">Name</th>
                            <th class="p-4">Office Space</th>
                            <th class="p-4">Period</th>
                            <th class="p-4">Is Paid?</th>
                            <th class="p-4">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($bookingTransactions as $bookingTransaction)
                        <tr class="border-b hover:bg-gray-50">
                             <td class="p-4">
                                {{ $bookingTransaction->booking_trx_id }}
                            </td>
                            <td class="p-4">
                                {{ $bookingTransaction->name }}
                            </td>
                            <td class="p-4">
                                {{ $bookingTransaction->officeSpace->name }}
                            </td>
                            <td class="p-4">
                                {{ $bookingTransaction->started_at->format('Y/m/d') }} -  {{ $bookingTransaction->ended_at->format('Y/m/d') }} 
                            </td>
                              <td class="p-4">
                                {{ $bookingTransaction->is_paid ? "Yes" : "No" }}
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    
                                    <a href="{{ route('admin.booking-transactions.edit', $bookingTransaction) }}"
                                    class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">
                                        Manage
                                    </a>

                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-slate-500">
                                    <p>Belum ada data Transactions</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-6 bg-white p-4 rounded-lg">
                    {{ $bookingTransactions->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>