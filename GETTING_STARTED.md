# 🎯 PANDUAN SINGKAT AKSES APLIKASI

## Step 1: Setup Database

Jika belum pernah setup sebelumnya:

```bash
# 1. Copy .env file
copy .env.example .env

# 2. Generate key
php artisan key:generate

# 3. Setup database - edit .env terlebih dahulu:
#    DB_DATABASE=futsal_reservasi
#    DB_USERNAME=root
#    DB_PASSWORD=(kosong atau sesuaikan)

# 4. Jalankan migration
php artisan migrate

# 5. Jalankan seeder untuk membuat data demo
php artisan db:seed

# 6. Buat storage link
php artisan storage:link
```

## Step 2: Jalankan Server

```bash
php artisan serve
```

Server akan jalan di: **http://localhost:8000**

## Step 3: Akses Aplikasi

### Landing Page
Buka browser ke: `http://localhost:8000`

Anda akan melihat:
- Navbar dengan menu Navigation
- Hero section dengan tombol Login dan Daftar
- Features section yang menjelaskan fitur-fitur
- Call to action

### Login dengan Demo Account

#### Customer (Pelanggan)
- **URL**: http://localhost:8000/login
- **Email**: customer@example.com
- **Password**: 123456
- **Setelah login**: http://localhost:8000/customer/dashboard

#### Admin (Pengelola)
- **URL**: http://localhost:8000/login
- **Email**: admin@example.com
- **Password**: 123456
- **Setelah login**: http://localhost:8000/admin/dashboard

#### Super Admin (Pengelola Sistem)
- **URL**: http://localhost:8000/login
- **Email**: superadmin@example.com
- **Password**: 123456
- **Setelah login**: http://localhost:8000/superadmin/dashboard

## Step 4: Test Fitur

### Sebagai Customer:
1. Login dengan akun customer
2. Klik "Lapangan" di navbar
3. Lihat daftar lapangan yang tersedia
4. Klik lapangan untuk melihat detail dan jadwal
5. Pilih waktu untuk membuat booking
6. Upload bukti pembayaran
7. Cek notifikasi untuk melihat status

### Sebagai Admin:
1. Login dengan akun admin
2. Dashboard menampilkan pending bookings dan payments
3. Review booking dan approve/reject
4. Verify pembayaran dari bukti yang diupload
5. Lihat semua booking dengan filter

### Sebagai Super Admin:
1. Login dengan akun super admin
2. Akses ke laporan sistem (revenue, transaksi, penggunaan)
3. Manage admin (tambah, edit, hapus)
4. Manage lapangan (CRUD)
5. Manage jadwal (CRUD)

## Folder Struktur Penting

```
laravel/
├── public/
│   ├── css/app.css          ← Stylesheet utama
│   └── js/app.js            ← JavaScript utama
├── resources/views/
│   ├── index.blade.php      ← Landing page
│   ├── auth/
│   │   ├── login.blade.php
│   │   └── register.blade.php
│   ├── layouts/             ← Template layout
│   ├── customer/            ← Customer pages
│   ├── admin/               ← Admin pages
│   └── superadmin/          ← Super admin pages
├── app/Http/
│   ├── Controllers/         ← Business logic
│   └── Middleware/          ← Auth & role checks
├── database/
│   ├── migrations/          ← Database schema
│   └── seeders/             ← Demo data
└── routes/
    └── web.php              ← URL routing
```

## File CSS & JavaScript

### CSS
File utama: `public/css/app.css`

Includes:
- Global styles (buttons, forms, tables)
- Navbar styling
- Card & container layouts
- Responsive grid system
- Alert & notification styles
- Badge styling

### JavaScript
File utama: `public/js/app.js`

Features:
- Auto-hide alerts after 5 seconds
- Time slot selection
- Price calculation
- Form validation
- Notification handling
- Date picker setup

## Database Tables

Setelah seeding, database Anda akan memiliki:

1. **users** - 4 akun demo
   - 1 super admin
   - 1 admin
   - 2 customer

2. **fields** - 3 lapangan
   - Lapangan A (Rp 100k/jam)
   - Lapangan B (Rp 120k/jam)
   - Lapangan C (Rp 150k/jam)

3. **schedules** - Jadwal untuk setiap lapangan
   - Jam buka/tutup
   - Harga per jam
   - Hari operasional

4. **bookings** - Kosong (untuk testing)

5. **payments** - Kosong (untuk testing)

6. **notifications** - Kosong (untuk testing)

7. **reports** - Kosong (untuk analytics)

## Troubleshooting

### 1. "Class not found" error
```bash
composer dump-autoload
```

### 2. "SQLSTATE HY000" error
- Check MySQL running
- Check DB credentials di .env
- Pastikan database sudah dibuat

### 3. "File not found" error saat upload bukti pembayaran
```bash
php artisan storage:link
```

### 4. Views tidak muncul
```bash
php artisan view:clear
php artisan config:clear
```

### 5. Lupa password
- Edit database langsung atau
- Buat user baru melalui register
- Atau jalankan: `php artisan tinker` kemudian update hash

## Routes Quick Reference

| Role | Dashboard | Main Features |
|------|-----------|---------------|
| **Customer** | `/customer/dashboard` | Booking, Payment, Notifications |
| **Admin** | `/admin/dashboard` | Review Booking, Verify Payment |
| **Super Admin** | `/superadmin/dashboard` | Reports, CRUD Admin/Field/Schedule |

## Support & Help

Lihat dokumentasi lengkap di:
- `README.md` - Gambaran umum
- `SETUP_GUIDE.md` - Setup detail
- `URL_GUIDE.md` - Daftar URL lengkap
- `API_DOCUMENTATION.md` - Dokumentasi API
- `QUICK_START.md` - Quick start guide

## Testing Workflow

### Scenario: Customer membuat booking

1. **Login sebagai Customer**
   - Email: customer@example.com, Password: 123456

2. **Cari & Pilih Lapangan**
   - Klik "Lapangan" di navbar
   - Pilih salah satu lapangan
   - Klik "Lihat Detail"

3. **Buat Booking**
   - Pilih tanggal booking
   - Pilih waktu (tersedia = hijau)
   - Klik "Booking"

4. **Upload Pembayaran**
   - Klik "Upload Bukti Pembayaran"
   - Upload gambar/file bukti transfer
   - Klik "Upload"

5. **Tunggu Verifikasi**
   - Cek dashboard - status "pending"
   - Cek notifikasi

6. **Login sebagai Admin**
   - Email: admin@example.com, Password: 123456

7. **Review Booking**
   - Klik "Booking Pending"
   - Review booking dari customer
   - Approve atau Reject

8. **Verify Payment**
   - Klik "Pembayaran Pending"
   - Lihat bukti pembayaran
   - Verify atau Reject

9. **Check sebagai Customer**
   - Refresh dashboard
   - Lihat status booking updated
   - Lihat notifikasi approval

Selesai! 🎉

## Notes

- Aplikasi menggunakan Blade template (Laravel)
- Database: MySQL dengan 7 tables
- Authentication: Laravel built-in
- Authorization: Custom middleware CheckRole & CheckActive
- Storage: Local (bisa diganti ke S3 dll)
