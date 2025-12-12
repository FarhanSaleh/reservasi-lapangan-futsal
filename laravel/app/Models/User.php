<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role', // user, admin, super_admin
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Get all bookings for this user (customer)
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Check if user is admin or super_admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin' || $this->role === 'super_admin';
    }

    /**
     * Check if user is super admin
     */
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    /**
     * Check if user is customer
     */
    public function isCustomer()
    {
        return $this->role === 'user';
    }
}
