<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id',
        'type', // pending, approved, rejected
        'title',
        'message',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Get the booking associated with this notification
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the user that received this notification
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
