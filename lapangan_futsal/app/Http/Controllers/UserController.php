<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        $roles = Role::get();
        return ['users' => $users, 'roles' => $roles]; // arahkan ke halaman data user
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,',
            'role_id' => 'required|exists:roles,id'
        ]);

        if ($validator->fails()) {
            return; // arahkan kembali ke form tambah user
        }

        $validated = $validator->validated();

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => '112233',
            'role_id' => $validated['role_id']
        ]);

        return; // arahkan ke halaman data user
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
            'role_id' => 'required|exists:roles,id'
        ]);

        if ($validator->fails()) {
            return; // arahkan kembali ke form edit user
        }

        $validated = $validator->validated();

        $user = User::find($id);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => $validated['role_id']
        ]);

        return; // arahkan ke halaman data user
    }

    public function destroy(string $id)
    {
        if (Auth::id() == $id) {
            return; // arahkan kembali ke halaman data user dengan pesan bahwa akun diri sendiri tidak dapat dihapus
        }

        $user = User::findOrFail($id);

        try {
            $user->delete();

            return; // arahkan ke halaman data user
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return; // arahkan kehalaman data user dengan pesan bahwa data tidak dapat dihapus karena memiliki data yang terkait
            }

            return; // arahkan kehalaman data user dengan pesan bahwa ada kesalahan
        }
    }

    public function showProfile()
    {
        $user = Auth::user();
        return ['user' => $user];
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$user->id",
            'password' => 'nullable|min:8',
            'password_confirmation' => 'same:password'
        ]);

        if ($validator->fails()) {
            return; // arahkan kembali ke halaman profil
        }

        $validated = $validator->validated();

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($validated['password']) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return; // arahkan kembali ke halaman profil
    }
}
