<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', // transaction, revenue, usage
        'period_start',
        'period_end',
        'data',
        'generated_by',
        'generated_at',
    ];

    protected $casts = [
        'data' => 'json',
        'period_start' => 'date',
        'period_end' => 'date',
        'generated_at' => 'datetime',
    ];

    /**
     * Get the user that generated this report
     */
    public function generatedBy()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }
}
