<?php

// Middleware configuration file

// This file documents the custom middleware used in the application
// All middleware classes are located in app/Http/Middleware/

// CheckRole middleware - Validates user role-based access
// Usage in routes: Route::middleware('check.role:admin,super_admin')->group(...)

// CheckActive middleware - Ensures user account is active
// Usage in routes: Route::middleware('check.active')->group(...)
