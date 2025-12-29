<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('user-dashboard', [
            'user'      => $user,
            'lapangan'  => Lapangan::where('status', 'tersedia')->get(),
            'reservasi' => Reservasi::where('user_id', $user->id)->get(),
        ]);
    }
}
