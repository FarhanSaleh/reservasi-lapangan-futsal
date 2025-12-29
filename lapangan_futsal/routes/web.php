<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserDashboardController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| AUTH VIEW
|--------------------------------------------------------------------------
*/
Route::get("/login", action[LoginController::class,"showLoginForm"])->name("login");
Route::get("/login", action[LoginController::class,"showLoginForm"])->name("login");
