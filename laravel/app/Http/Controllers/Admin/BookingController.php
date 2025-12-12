<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Update booking status
     */
    public function updateStatus($bookingId, Request $request)
    {
        $booking = Booking::findOrFail($bookingId);
        
        $request->validate([
            'status' => 'required|in:pending,confirmed,rejected,completed',
            'notes' => 'nullable|string',
        ]);

        $booking->update([
            'status' => $request->input('status'),
        ]);

        return back()->with('success', 'Booking status updated.');
    }

    /**
     * Delete booking
     */
    public function delete($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $booking->delete();

        return back()->with('success', 'Booking deleted.');
    }
}
