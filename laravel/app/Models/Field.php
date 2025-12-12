<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
        'facilities',
        'price_per_hour',
        'is_active',
    ];

    protected $casts = [
        'facilities' => 'json',
        'price_per_hour' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get all schedules for this field
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Get all bookings for this field
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Check if field is available at specific time
     */
    public function isAvailable($date, $startTime, $endTime)
    {
        return !Booking::where('field_id', $this->id)
            ->where('booking_date', $date)
            ->where('status', '!=', 'rejected')
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($q) use ($startTime, $endTime) {
                        $q->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                    });
            })
            ->exists();
    }
}
