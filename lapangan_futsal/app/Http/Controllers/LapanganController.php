<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    public function index()
    {
        $lapangan = Lapangan::all();
        return view('admin.lapangan.index', compact('lapangan'));
    }

    public function create()
    {
        return view('admin.lapangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lapangan' => 'required',
            'harga_per_jam' => 'required|integer',
        ]);

        Lapangan::create([
            'nama_lapangan' => $request->nama_lapangan,
            'harga_per_jam' => $request->harga_per_jam,
            'status' => 'tersedia',
        ]);

        return redirect()->route('admin.lapangan.index')
            ->with('success', 'Lapangan berhasil ditambahkan');
    }
}
