<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Show all admins
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = User::where('role', 'admin');
        
        if ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        }
        
        $admins = $query->paginate(15);
        
        return view('superadmin.admins.index', compact('admins', 'search'));
    }

    /**
     * Show create admin form
     */
    public function create()
    {
        return view('superadmin.admins.create');
    }

    /**
     * Store new admin
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'role' => 'admin',
            'is_active' => true,
        ]);

        return redirect()->route('superadmin.admins.index')
            ->with('success', 'Admin created successfully.');
    }

    /**
     * Show edit admin form
     */
    public function edit($adminId)
    {
        $admin = User::where('role', 'admin')->findOrFail($adminId);
        
        return view('superadmin.admins.edit', compact('admin'));
    }

    /**
     * Update admin
     */
    public function update($adminId, Request $request)
    {
        $admin = User::where('role', 'admin')->findOrFail($adminId);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
            'is_active' => 'boolean',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $admin->update($updateData);

        return redirect()->route('superadmin.admins.index')
            ->with('success', 'Admin updated successfully.');
    }

    /**
     * Delete admin
     */
    public function delete($adminId)
    {
        $admin = User::where('role', 'admin')->findOrFail($adminId);
        $admin->delete();

        return back()->with('success', 'Admin deleted successfully.');
    }
}
