<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'field_id',
        'booking_date',
        'start_time',
        'end_time',
        'customer_name',
        'customer_phone',
        'notes',
        'status', // pending, confirmed, rejected, completed
        'total_price',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'total_price' => 'decimal:2',
    ];

    /**
     * Get the user that made this booking
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the field that was booked
     */
    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    /**
     * Get the payment associated with this booking
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Get all notifications for this booking
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
