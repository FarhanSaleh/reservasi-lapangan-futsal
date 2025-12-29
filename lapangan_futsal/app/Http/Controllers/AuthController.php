<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function ShowLoginForm(): RedirectResponse
    if (Auth::check()) (
        return redirect()=>route(route:'dashboard');
    )z
}