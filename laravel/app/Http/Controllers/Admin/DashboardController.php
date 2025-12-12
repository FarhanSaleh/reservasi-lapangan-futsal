<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Notification;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        $stats = [
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'pending_payments' => Payment::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
            'total_revenue' => Booking::where('status', 'confirmed')->sum('total_price'),
        ];
        
        $pendingBookings = Booking::where('status', 'pending')
            ->with(['user', 'field', 'payment'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        
        $pendingPayments = Payment::where('status', 'pending')
            ->with(['booking.user', 'booking.field'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        
        return view('admin.dashboard', compact('stats', 'pendingBookings', 'pendingPayments'));
    }

    /**
     * Show pending bookings
     */
    public function pendingBookings(Request $request)
    {
        $query = Booking::where('status', 'pending')
            ->with(['user', 'field', 'payment']);
        
        $sortBy = $request->input('sort_by', 'created_at');
        $query->orderBy($sortBy, 'desc');
        
        $bookings = $query->paginate(15);
        
        return view('admin.pending-bookings', compact('bookings'));
    }

    /**
     * Show booking details
     */
    public function bookingDetails($bookingId)
    {
        $booking = Booking::with(['user', 'field', 'payment', 'notifications'])->findOrFail($bookingId);
        
        return view('admin.booking-details', compact('booking'));
    }

    /**
     * Approve booking
     */
    public function approveBooking($bookingId, Request $request)
    {
        $booking = Booking::findOrFail($bookingId);
        
        $request->validate([
            'notes' => 'nullable|string',
        ]);

        $booking->update([
            'status' => 'confirmed',
        ]);

        // Update payment status
        if ($booking->payment) {
            $booking->payment()->update([
                'status' => 'verified',
                'verified_by' => auth()->id(),
                'verified_at' => now(),
                'notes' => $request->input('notes'),
            ]);
        }

        // Create notification
        Notification::create([
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
            'type' => 'approved',
            'title' => 'Booking Approved',
            'message' => 'Your reservation has been approved. Please arrive 15 minutes before your booking time.',
        ]);

        return redirect()->route('admin.pending-bookings')
            ->with('success', 'Booking approved and payment verified.');
    }

    /**
     * Reject booking
     */
    public function rejectBooking($bookingId, Request $request)
    {
        $booking = Booking::findOrFail($bookingId);
        
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $booking->update([
            'status' => 'rejected',
        ]);

        // Update payment status
        if ($booking->payment) {
            $booking->payment()->update([
                'status' => 'rejected',
                'verified_by' => auth()->id(),
                'verified_at' => now(),
                'notes' => $request->input('rejection_reason'),
            ]);
        }

        // Create notification
        Notification::create([
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
            'type' => 'rejected',
            'title' => 'Booking Rejected',
            'message' => 'Your reservation has been rejected. Reason: ' . $request->input('rejection_reason'),
        ]);

        return redirect()->route('admin.pending-bookings')
            ->with('success', 'Booking rejected.');
    }

    /**
     * Show pending payments
     */
    public function pendingPayments(Request $request)
    {
        $query = Payment::where('status', 'pending')
            ->with(['booking.user', 'booking.field']);
        
        $sortBy = $request->input('sort_by', 'created_at');
        $query->orderBy($sortBy, 'desc');
        
        $payments = $query->paginate(15);
        
        return view('admin.pending-payments', compact('payments'));
    }

    /**
     * Show payment details
     */
    public function paymentDetails($paymentId)
    {
        $payment = Payment::with(['booking.user', 'booking.field'])->findOrFail($paymentId);
        
        return view('admin.payment-details', compact('payment'));
    }

    /**
     * Verify payment
     */
    public function verifyPayment($paymentId, Request $request)
    {
        $payment = Payment::with('booking')->findOrFail($paymentId);
        
        $request->validate([
            'notes' => 'nullable|string',
        ]);

        $payment->update([
            'status' => 'verified',
            'verified_by' => auth()->id(),
            'verified_at' => now(),
            'notes' => $request->input('notes'),
        ]);

        // Update booking status
        $payment->booking()->update(['status' => 'confirmed']);

        // Create notification
        Notification::create([
            'booking_id' => $payment->booking->id,
            'user_id' => $payment->booking->user_id,
            'type' => 'approved',
            'title' => 'Payment Verified',
            'message' => 'Your payment has been verified. Your reservation is confirmed.',
        ]);

        return redirect()->route('admin.pending-payments')
            ->with('success', 'Payment verified.');
    }

    /**
     * Reject payment
     */
    public function rejectPayment($paymentId, Request $request)
    {
        $payment = Payment::with('booking')->findOrFail($paymentId);
        
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $payment->update([
            'status' => 'rejected',
            'verified_by' => auth()->id(),
            'verified_at' => now(),
            'notes' => $request->input('rejection_reason'),
        ]);

        // Update booking status
        $payment->booking()->update(['status' => 'rejected']);

        // Create notification
        Notification::create([
            'booking_id' => $payment->booking->id,
            'user_id' => $payment->booking->user_id,
            'type' => 'rejected',
            'title' => 'Payment Rejected',
            'message' => 'Your payment has been rejected. Reason: ' . $request->input('rejection_reason'),
        ]);

        return redirect()->route('admin.pending-payments')
            ->with('success', 'Payment rejected.');
    }

    /**
     * Show all bookings
     */
    public function allBookings(Request $request)
    {
        $status = $request->input('status');
        $fieldId = $request->input('field_id');
        
        $query = Booking::with(['user', 'field', 'payment']);
        
        if ($status) {
            $query->where('status', $status);
        }
        
        if ($fieldId) {
            $query->where('field_id', $fieldId);
        }
        
        $bookings = $query->orderBy('booking_date', 'desc')->paginate(15);
        
        return view('admin.all-bookings', compact('bookings', 'status', 'fieldId'));
    }
}
