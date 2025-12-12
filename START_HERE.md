# 🚀 MULAI JALANKAN APLIKASI - PANDUAN STEP-BY-STEP

## Prasyarat yang Harus Sudah Ada

✅ Laravel & PHP 8.0+ terinstall di `c:\laragon\www\reservasi-lapangan-futsal`
✅ Composer sudah terinstall
✅ MySQL/MariaDB running di Laragon
✅ Editor (VS Code, Sublime, dll) sudah dibuka

## STEP 1: Setup Environment File (Pertama kali saja)

### Jika belum ada .env:
```powershell
# Buka PowerShell di folder project
cd c:\laragon\www\reservasi-lapangan-futsal

# Copy dari .env.example ke .env
copy .env.example .env
```

### Konfigurasi .env:
Edit file `.env` dan pastikan database config:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=futsal_reservasi
DB_USERNAME=root
DB_PASSWORD=
```

## STEP 2: Generate Application Key (Pertama kali saja)

```powershell
php artisan key:generate
```

Akan melihat output:
```
Application key set successfully.
```

## STEP 3: Buat Database (Pertama kali saja)

### Via phpMyAdmin:
1. Buka phpMyAdmin: http://localhost/phpmyadmin
2. Klik "New" di sidebar
3. Database name: `futsal_reservasi`
4. Collation: utf8mb4_unicode_ci
5. Klik "Create"

### Via Command:
```powershell
mysql -u root -p
CREATE DATABASE futsal_reservasi;
EXIT;
```

## STEP 4: Jalankan Database Migrations

```powershell
php artisan migrate
```

Output akan menunjukkan semua table yang dibuat:
```
Creating table users
Creating table fields
Creating table schedules
Creating table bookings
Creating table payments
Creating table notifications
Creating table reports
Migration table created successfully.
```

## STEP 5: Jalankan Database Seeder (Pertama kali saja)

```powershell
php artisan db:seed
```

Output:
```
Seeding: Database\Seeders\DatabaseSeeder
Demo Accounts:
==============
Super Admin: superadmin@example.com / 123456
Admin: admin@example.com / 123456
Customer 1: customer@example.com / 123456
Customer 2: andi@example.com / 123456
```

## STEP 6: Buat Storage Link (Pertama kali saja)

Untuk upload bukti pembayaran:
```powershell
php artisan storage:link
```

Akan membuat symbolic link ke `storage/app/public`

## STEP 7: Jalankan Development Server

```powershell
php artisan serve
```

Output:
```
Laravel development server started: http://127.0.0.1:8000

[INFO] Listening on http://127.0.0.1:8000
```

Server akan berjalan di: **http://127.0.0.1:8000**

## STEP 8: Buka di Browser

### Landing Page:
```
http://localhost:8000
```

Anda akan melihat:
- Navbar dengan logo "⚽ FUTSAL RESERVASI"
- Hero section dengan button "Masuk Sekarang" dan "Daftar Gratis"
- Features section dengan 6 fitur unggulan
- About section
- Footer

### Login Page:
```
http://localhost:8000/login
```

## STEP 9: Test dengan Demo Account

### Test 1: Login sebagai Customer

1. Buka: http://localhost:8000/login
2. Masukkan:
   - **Email**: customer@example.com
   - **Password**: 123456
3. Klik "Login"
4. Akan redirect ke: http://localhost:8000/customer/dashboard

Dashboard menampilkan:
- Stat cards: Total booking, Pending, Confirmed, Notifications
- Recent bookings table
- Quick actions buttons

### Test 2: Lihat Lapangan

1. Dari dashboard, klik "Lapangan" di navbar
2. Atau buka: http://localhost:8000/customer/fields
3. Akan melihat grid 3 lapangan:
   - Lapangan A (Rp 100k/jam)
   - Lapangan B (Rp 120k/jam)
   - Lapangan C (Rp 150k/jam)

### Test 3: Buat Booking

1. Klik salah satu lapangan
2. Pilih tanggal booking
3. Pilih waktu (slot hijau = tersedia)
4. Klik "Booking"
5. Lihat notifikasi "Booking berhasil dibuat"

### Test 4: Upload Pembayaran

1. Dari dashboard, klik booking yang pending
2. Atau buka: http://localhost:8000/customer/payment-form/{booking-id}
3. Upload file bukti pembayaran (gambar/PDF)
4. Klik "Upload"
5. Status akan berubah ke "payment_pending"

### Test 5: Lihat Notifikasi

1. Klik "Notifikasi" di navbar
2. Lihat list notifikasi untuk booking Anda
3. Klik notifikasi untuk read/mark as read

### Test 6: Login sebagai Admin

1. Logout: klik tombol "Logout"
2. Atau buka: http://localhost:8000/login (otomatis redirect)
3. Masukkan:
   - **Email**: admin@example.com
   - **Password**: 123456

Dashboard Admin menampilkan:
- Pending booking overview
- Pending payment overview

### Test 7: Review Booking

1. Dari dashboard, klik "Booking Pending"
2. Lihat list booking dari customer
3. Klik "Detail" untuk melihat detail booking
4. Pilih "Approve" atau "Reject"
5. Jika approve, akan membuat notification ke customer

### Test 8: Verify Payment

1. Dari dashboard, klik "Pembayaran Pending"
2. Lihat bukti pembayaran dari customer
3. Klik "Verify" untuk approve
4. Atau "Reject" jika ada masalah

### Test 9: Login sebagai Super Admin

1. Logout dan login dengan:
   - **Email**: superadmin@example.com
   - **Password**: 123456

Dashboard Super Admin menampilkan:
- System stats (users, admins, fields, bookings, revenue)
- Recent bookings

### Test 10: Manage Lapangan

1. Klik "Fields" atau Lapangan di sidebar
2. Lihat daftar 3 lapangan yang sudah ada
3. Klik "Tambah" untuk add lapangan baru
4. Isi form:
   - Nama: "Lapangan D"
   - Lokasi: "Jl. Test"
   - Fasilitas: Centang beberapa
   - Deskripsi: "Test lapangan"
5. Klik "Simpan"
6. Kembali ke list, lapangan baru akan terlihat

### Test 11: Manage Schedule

1. Klik "Schedule" di sidebar
2. Lihat jadwal untuk setiap lapangan
3. Klik "Tambah" untuk add schedule baru
4. Pilih field, hari, jam buka/tutup, harga
5. Klik "Simpan"

### Test 12: Manage Admin

1. Klik "Admin" di sidebar
2. Lihat 1 admin yang sudah ada
3. Klik "Tambah" untuk add admin baru
4. Isi form:
   - Nama: "Admin Baru"
   - Email: "admin2@example.com"
   - Password: "123456"
5. Klik "Simpan"
6. Admin baru bisa login

### Test 13: Lihat Report

1. Klik "Laporan" atau Report menu
2. Lihat:
   - Revenue Report (total revenue by date)
   - Transaction Report (status summary)
   - Usage Report (field hours)

## STEP 10: Keluar dari Server

Tekan: **CTRL + C** di PowerShell

Akan berhenti dengan output:
```
[INFO] Server stopped.
```

## Checklist Selesai

Jika semua test berhasil:

✅ Database migrations berhasil
✅ Seeder berhasil membuat data demo
✅ Landing page bisa diakses
✅ Login/Register berfungsi
✅ Customer bisa booking
✅ Admin bisa review
✅ Super Admin bisa manage
✅ Upload pembayaran berfungsi
✅ Notifikasi berfungsi
✅ CRUD lapangan/schedule/admin berfungsi
✅ Report berfungsi

## Troubleshooting

### Error: "Database connection refused"
**Solusi:**
```powershell
# 1. Pastikan MySQL running
# 2. Check .env database config
# 3. Jalankan: php artisan migrate
```

### Error: "Class not found"
**Solusi:**
```powershell
composer dump-autoload
```

### Error: "View not found"
**Solusi:**
```powershell
php artisan view:clear
php artisan config:clear
```

### Error: "File upload failed"
**Solusi:**
```powershell
# Pastikan storage link sudah dibuat
php artisan storage:link
```

### Port 8000 sudah dipakai
**Solusi:**
```powershell
# Gunakan port lain
php artisan serve --port=8001
# Maka akses: http://localhost:8001
```

## Next Steps

Setelah semua berjalan baik:

1. **Kustomisasi**
   - Ganti nama aplikasi di .env
   - Ganti colors/theme di public/css/app.css
   - Ganti konten di views

2. **Tambah Fitur**
   - Email notifications
   - SMS notifications
   - Payment gateway
   - Export to PDF
   - Admin dashboard charts

3. **Deploy**
   - Upload ke hosting
   - Setup domain
   - Configure SSL
   - Setup email service

## File Dokumentasi yang Berguna

Jika perlu referensi lebih lanjut:
- `README.md` - Overview sistem
- `SETUP_GUIDE.md` - Setup detail
- `URL_GUIDE.md` - Daftar semua URL
- `API_DOCUMENTATION.md` - API reference
- `SYSTEM_COMPLETE.md` - Ringkasan lengkap

---

## ⚡ Quick Start Commands

Copy-paste semua commands ini berturut-turut:

```powershell
cd c:\laragon\www\reservasi-lapangan-futsal
copy .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve
```

Kemudian buka browser ke: **http://localhost:8000**

Login dengan:
- Customer: customer@example.com / 123456
- Admin: admin@example.com / 123456
- Super Admin: superadmin@example.com / 123456

Enjoy! 🎉
