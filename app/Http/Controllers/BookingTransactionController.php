<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingTransactionRequest;
use App\Http\Requests\UpdateBookingTransactionRequest;
use App\Models\BookingTransaction;
use App\Models\OfficeSpace;
use Illuminate\Support\Facades\DB;

class BookingTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookingTransactions = BookingTransaction::latest()->paginate(10);

        return view('admin.booking-transaction.index', compact('bookingTransactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $officeSpaces = OfficeSpace::latest()->get();

        return view('admin.booking-transaction.create', compact('officeSpaces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingTransactionRequest $request)
    {
        DB::transaction(function() use ($request){
            $validated = $request->validated();

            $bookingTransaction = BookingTransaction::create($validated);
        });

        return redirect()->route('admin.booking-transactions.index')->with('success', 'new booking added succsessfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(BookingTransaction $bookingTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookingTransaction $bookingTransaction)
    {
        $officeSpaces = OfficeSpace::latest()->get();

        return view('admin.booking-transaction.edit', compact('officeSpaces', 'bookingTransaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingTransactionRequest $request, BookingTransaction $bookingTransaction)
    {
        DB::transaction(function() use ($request, $bookingTransaction){
            $validated = $request->validated();

            $bookingTransaction->update($validated);                
        });

        return redirect()->route('admin.booking-transactions.index')->with('success', 'booking transaction updated succsessfully');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookingTransaction $bookingTransaction)
    {
        DB::transaction(function() use ($bookingTransaction){
            $bookingTransaction->delete();
        });

        return redirect()->route('admin.booking-transactions.index')->with('success', 'delete trannsactions succseffully');
    }
}
