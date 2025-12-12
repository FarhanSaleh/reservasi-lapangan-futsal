<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Booking;
use App\Models\Notification;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show customer dashboard
     */
    public function index()
    {
        $user = auth()->user();
        
        $stats = [
            'total_bookings' => Booking::where('user_id', $user->id)->count(),
            'pending_bookings' => Booking::where('user_id', $user->id)->where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('user_id', $user->id)->where('status', 'confirmed')->count(),
            'unread_notifications' => Notification::where('user_id', $user->id)->where('is_read', false)->count(),
        ];
        
        $recentBookings = Booking::where('user_id', $user->id)
            ->with(['field', 'payment'])
            ->orderBy('booking_date', 'desc')
            ->take(5)
            ->get();
        
        return view('customer.dashboard', compact('stats', 'recentBookings'));
    }

    /**
     * Show available fields
     */
    public function fields(Request $request)
    {
        $date = $request->input('date', now()->format('Y-m-d'));
        
        $fields = Field::where('is_active', true)->get();
        
        return view('customer.fields', compact('fields', 'date'));
    }

    /**
     * Show field details and available times
     */
    public function fieldDetails($fieldId, Request $request)
    {
        $field = Field::findOrFail($fieldId);
        $date = $request->input('date', now()->format('Y-m-d'));
        
        // Get all bookings for this date to check availability
        $bookings = Booking::where('field_id', $fieldId)
            ->where('booking_date', $date)
            ->where('status', '!=', 'rejected')
            ->get();
        
        return view('customer.field-details', compact('field', 'date', 'bookings'));
    }

    /**
     * Show booking form
     */
    public function showBookingForm($fieldId, Request $request)
    {
        $field = Field::findOrFail($fieldId);
        $date = $request->input('date');
        $startTime = $request->input('start_time');
        
        return view('customer.booking-form', compact('field', 'date', 'startTime'));
    }

    /**
     * Store new booking
     */
    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'field_id' => 'required|exists:fields,id',
            'booking_date' => 'required|date|after:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'notes' => 'nullable|string',
        ]);

        $field = Field::findOrFail($validated['field_id']);
        
        // Check availability
        if (!$field->isAvailable($validated['booking_date'], $validated['start_time'], $validated['end_time'])) {
            return back()->with('error', 'Field not available for selected time');
        }

        // Calculate total price
        $startTime = \Carbon\Carbon::createFromFormat('H:i', $validated['start_time']);
        $endTime = \Carbon\Carbon::createFromFormat('H:i', $validated['end_time']);
        $hours = $startTime->diffInHours($endTime);
        $totalPrice = $hours * $field->price_per_hour;

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'field_id' => $validated['field_id'],
            'booking_date' => $validated['booking_date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'notes' => $validated['notes'],
            'status' => 'pending',
            'total_price' => $totalPrice,
        ]);

        // Create payment record
        $booking->payment()->create([
            'amount' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('customer.payment-form', $booking->id)
            ->with('success', 'Booking created. Please upload payment proof.');
    }

    /**
     * Show payment upload form
     */
    public function showPaymentForm($bookingId)
    {
        $booking = Booking::with('payment')->findOrFail($bookingId);
        
        // Check if booking belongs to current user
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('customer.payment-form', compact('booking'));
    }

    /**
     * Store payment proof
     */
    public function storePaymentProof($bookingId, Request $request)
    {
        $booking = Booking::with('payment')->findOrFail($bookingId);
        
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('payment_proof')->store('payment-proofs', 'public');

        $booking->payment()->update([
            'payment_proof_path' => $path,
        ]);

        // Create notification
        Notification::create([
            'booking_id' => $booking->id,
            'user_id' => auth()->id(),
            'type' => 'pending',
            'title' => 'Payment Proof Uploaded',
            'message' => 'Your payment proof has been uploaded. Waiting for admin verification.',
        ]);

        return redirect()->route('customer.booking-history')
            ->with('success', 'Payment proof uploaded. Please wait for admin verification.');
    }

    /**
     * Show booking history
     */
    public function bookingHistory(Request $request)
    {
        $status = $request->input('status');
        
        $query = Booking::where('user_id', auth()->id())
            ->with(['field', 'payment', 'notifications']);
        
        if ($status) {
            $query->where('status', $status);
        }
        
        $bookings = $query->orderBy('booking_date', 'desc')->paginate(10);
        
        return view('customer.booking-history', compact('bookings', 'status'));
    }

    /**
     * Show notifications
     */
    public function notifications()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('customer.notifications', compact('notifications'));
    }

    /**
     * Mark notification as read
     */
    public function markNotificationRead($notificationId)
    {
        $notification = Notification::findOrFail($notificationId);
        
        if ($notification->user_id !== auth()->id()) {
            abort(403);
        }

        $notification->update(['is_read' => true]);

        return back();
    }
}
