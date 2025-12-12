# 🚀 PANDUAN SETUP APLIKASI

## Prasyarat
- PHP 8.0+ 
- Composer
- MySQL/MariaDB
- Node.js & NPM (opsional, untuk asset building)

## Langkah-Langkah Setup

### 1. Clone atau Download Project
```bash
cd c:\laragon\www\reservasi-lapangan-futsal
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Copy Environment File
```bash
copy .env.example .env
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Konfigurasi Database
Edit file `.env` dan sesuaikan konfigurasi database:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=futsal_reservasi
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Buat Database
Buat database baru dengan nama `futsal_reservasi` menggunakan phpMyAdmin atau MySQL CLI:
```bash
mysql -u root
CREATE DATABASE futsal_reservasi;
EXIT;
```

### 7. Jalankan Migrations
```bash
php artisan migrate
```

### 8. Create Storage Link
```bash
php artisan storage:link
```

### 9. Mulai Server
```bash
php artisan serve
```

Server akan berjalan di `http://127.0.0.1:8000`

## Demo Accounts

Setelah migration berhasil, Anda dapat membuat akun demo atau menggunakan seeder.

### Test Credentials:
```
Customer:
Email: customer@example.com
Password: 123456

Admin:
Email: admin@example.com
Password: 123456

Super Admin:
Email: superadmin@example.com
Password: 123456
```

## Struktur Folder

```
laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Controller by role
│   │   ├── Middleware/       # Authentication & Authorization
│   │   └── Kernel.php
│   └── Models/               # Database Models
├── database/
│   └── migrations/           # Database Schema
├── resources/
│   ├── views/                # Blade Templates
│   └── lang/                 # Translation Files
├── routes/
│   └── web.php               # All Routes
├── storage/
│   └── payment-proofs/       # Upload direktori
├── public/
│   ├── css/                  # Stylesheets
│   ├── js/                   # JavaScript
│   └── images/               # Images
└── .env                      # Environment Config
```

## Fitur Utama

### 1. Customer/User
- Registrasi & Login
- Lihat daftar lapangan
- Booking lapangan dengan pilihan jam
- Upload bukti pembayaran
- Lihat riwayat booking
- Terima notifikasi

### 2. Admin
- Dashboard dengan pending bookings
- Review & approve/reject booking
- Verify payment proofs
- Lihat semua booking
- Manage status booking

### 3. Super Admin
- Dashboard dengan statistik sistem
- CRUD Admin (Create, Read, Update, Delete)
- CRUD Lapangan
- CRUD Jadwal (Schedule)
- Laporan Revenue
- Laporan Transaksi
- Laporan Penggunaan

## Troubleshooting

### Database Connection Error
- Pastikan MySQL/MariaDB running
- Check credentials di `.env`
- Jalankan `php artisan migrate`

### Storage Link Error
- Jalankan: `php artisan storage:link`
- Pastikan folder `storage/app/public` ada

### View Not Found
- Clear cache: `php artisan view:clear`
- Clear config: `php artisan config:clear`

### 404 Not Found
- Check route: `php artisan route:list`
- Pastikan middleware sudah benar

### Permission Denied
- Check middleware: `CheckRole` dan `CheckActive`
- Verify user role di database

## Support

Untuk bantuan lebih lanjut, lihat dokumentasi di:
- `README.md` - Overview lengkap
- `API_DOCUMENTATION.md` - Dokumentasi API
- `QUICK_START.md` - Setup cepat
- `INSTALLATION_CHECKLIST.md` - Checklist verifikasi
