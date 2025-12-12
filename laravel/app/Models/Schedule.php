<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_id',
        'day_of_week', // 0-6 (Sunday-Saturday)
        'open_time',
        'close_time',
        'price_per_hour',
    ];

    protected $casts = [
        'price_per_hour' => 'decimal:2',
    ];

    /**
     * Get the field that owns this schedule
     */
    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
