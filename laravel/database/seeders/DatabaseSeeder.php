<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Field;
use App\Models\Schedule;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Super Admin User
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'phone' => '081234567890',
            'password' => Hash::make('123456'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        // Create Admin Users
        User::create([
            'name' => 'Admin Lapangan',
            'email' => 'admin@example.com',
            'phone' => '082345678901',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Create Customer Users
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'customer@example.com',
            'phone' => '083456789012',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Andi Wijaya',
            'email' => 'andi@example.com',
            'phone' => '084567890123',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'is_active' => true,
        ]);

        // Create Fields
        $field1 = Field::create([
            'name' => 'Lapangan A',
            'location' => 'Jl. Merdeka No. 123, Jakarta',
            'facilities' => json_encode(['Parkir Gratis', 'Toilet', 'Kantin', 'WiFi']),
            'description' => 'Lapangan futsal berkualitas internasional dengan pencahayaan LED',
        ]);

        $field2 = Field::create([
            'name' => 'Lapangan B',
            'location' => 'Jl. Sudirman No. 456, Jakarta',
            'facilities' => json_encode(['Parkir Berbayar', 'Ruang Istirahat', 'Ganti Baju']),
            'description' => 'Lapangan futsal dengan standar kompetisi nasional',
        ]);

        $field3 = Field::create([
            'name' => 'Lapangan C',
            'location' => 'Jl. Ahmad Yani No. 789, Bandung',
            'facilities' => json_encode(['Parkir Gratis', 'Restoran', 'Kafe', 'AC']),
            'description' => 'Lapangan futsal modern dengan fasilitas lengkap',
        ]);

        // Create Schedules untuk Lapangan A
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $dayNumbers = [1, 2, 3, 4, 5, 6, 0]; // 0 = Sunday, 1 = Monday, etc

        foreach ($dayNumbers as $index => $dayNumber) {
            Schedule::create([
                'field_id' => $field1->id,
                'day_of_week' => $dayNumber,
                'start_time' => '08:00',
                'end_time' => '22:00',
                'price_per_hour' => 100000,
            ]);
        }

        // Create Schedules untuk Lapangan B
        foreach ($dayNumbers as $index => $dayNumber) {
            Schedule::create([
                'field_id' => $field2->id,
                'day_of_week' => $dayNumber,
                'start_time' => '07:00',
                'end_time' => '23:00',
                'price_per_hour' => 120000,
            ]);
        }

        // Create Schedules untuk Lapangan C
        foreach ($dayNumbers as $index => $dayNumber) {
            Schedule::create([
                'field_id' => $field3->id,
                'day_of_week' => $dayNumber,
                'start_time' => '06:00',
                'end_time' => '00:00',
                'price_per_hour' => 150000,
            ]);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('');
        $this->command->info('Demo Accounts:');
        $this->command->info('==============');
        $this->command->info('Super Admin: superadmin@example.com / 123456');
        $this->command->info('Admin: admin@example.com / 123456');
        $this->command->info('Customer 1: customer@example.com / 123456');
        $this->command->info('Customer 2: andi@example.com / 123456');
    }
}
