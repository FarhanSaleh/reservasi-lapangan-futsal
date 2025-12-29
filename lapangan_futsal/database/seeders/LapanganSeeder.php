<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LapanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DB::table('lapangan')->insert([
        [
            'nama_lapangan' => 'Lapangan A',
            'harga_per_jam' => 100000,
            'status' => 'tersedia',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nama_lapangan' => 'Lapangan B',
            'harga_per_jam' => 120000,
            'status' => 'maintenance',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
}

}
