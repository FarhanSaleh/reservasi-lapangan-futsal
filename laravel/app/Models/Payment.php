<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'amount',
        'payment_proof_path',
        'status', // pending, verified, rejected
        'verified_by',
        'verified_at',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'verified_at' => 'datetime',
    ];

    /**
     * Get the booking associated with this payment
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the admin that verified this payment
     */
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
