<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Field;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show super admin dashboard
     */
    public function index()
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_fields' => Field::count(),
            'total_bookings' => Booking::count(),
            'total_revenue' => Booking::where('status', 'confirmed')->sum('total_price'),
            'pending_payments' => Payment::where('status', 'pending')->count(),
        ];
        
        $recentBookings = Booking::with(['user', 'field'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        return view('superadmin.dashboard', compact('stats', 'recentBookings'));
    }

    /**
     * Show revenue report
     */
    public function revenueReport(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth());
        
        $revenue = Booking::where('status', 'confirmed')
            ->whereBetween('booking_date', [$startDate, $endDate])
            ->sum('total_price');
        
        $bookings = Booking::with(['user', 'field'])
            ->where('status', 'confirmed')
            ->whereBetween('booking_date', [$startDate, $endDate])
            ->orderBy('booking_date', 'desc')
            ->get();
        
        return view('superadmin.revenue-report', compact('revenue', 'bookings', 'startDate', 'endDate'));
    }

    /**
     * Show transaction report
     */
    public function transactionReport(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth());
        
        $transactions = Payment::with(['booking.user', 'booking.field', 'verifiedBy'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        $summary = [
            'total_verified' => Payment::where('status', 'verified')->whereBetween('created_at', [$startDate, $endDate])->count(),
            'total_pending' => Payment::where('status', 'pending')->whereBetween('created_at', [$startDate, $endDate])->count(),
            'total_rejected' => Payment::where('status', 'rejected')->whereBetween('created_at', [$startDate, $endDate])->count(),
        ];
        
        return view('superadmin.transaction-report', compact('transactions', 'summary', 'startDate', 'endDate'));
    }

    /**
     * Show usage report
     */
    public function usageReport(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth());
        
        $fields = Field::with(['bookings' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('booking_date', [$startDate, $endDate])
                ->where('status', 'confirmed');
        }])->get();
        
        $bookings = Booking::with(['field', 'user'])
            ->where('status', 'confirmed')
            ->whereBetween('booking_date', [$startDate, $endDate])
            ->get();
        
        return view('superadmin.usage-report', compact('fields', 'bookings', 'startDate', 'endDate'));
    }
}
