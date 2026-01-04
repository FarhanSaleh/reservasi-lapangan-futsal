<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Field;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $totalUsers = User::count();
        $totalLapangan = Field::count();
        $totalJadwal = Schedule::count();

        $totalReservasi = 0;
        $reservations = Reservation::with('user', 'schedule.field')->orderBy('reservation_date', 'desc')->limit(5)->get();

        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($user->hasRole('admin') || $user->hasRole('pengelola')) {
            $totalReservasi = Reservation::count();
        } else {
            $reservations = Reservation::with('user', 'schedule.field')->where('user_id', $user->id)->orderBy('reservation_date', 'desc')->limit(5)->get();
            $totalReservasi = Reservation::where('user_id', $user->id)->count();
        }

        return view('tes.dashboard', compact('totalUsers', 'totalLapangan', 'totalJadwal', 'totalReservasi', 'reservations'));
    }
}
