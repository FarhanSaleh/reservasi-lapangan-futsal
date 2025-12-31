<?php

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

if (!function_exists('catat_log')) {
    function catat_log($action, $description)
    {
        ActivityLog::create([
            'user_id'      => Auth::id(),
            'action'       => $action,
            'description'  => $description,
            'ip_address'   => request()->ip(),
        ]);
    }
}
