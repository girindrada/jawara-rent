<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingTransaction extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'phone_number',
        'booking_trx_id',
        'office_space_id',
        'total_amount',
        'duration',
        'started_at',
        'ended_at',
        'is_paid',
    ];

    protected $casts = [
        'started_at' => 'date',
        'ended_at' => 'date',  
    ];

    public function generateUniqueTrxId()
    {
        /**
         * self:: artinya mengacu ke class yang sedang dipakai, yaitu BookingTransaction.
         * Jadi sebenarnya kodenya sama seperti menulis:
         * 
         * BookingTransaction::where('booking_trx_id', $randomString)->exists();
         */

        $prefix = "JWRA";
        do{
            $randomString = $prefix . mt_rand(1000, 9999);
        } while (self::where('booking_trx_id', $randomString)->exists());

        return $randomString;
    }

    public function officeSpace()
    {
        return $this->belongsTo(OfficeSpace::class);
    }

}
