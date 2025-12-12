# 📋 DAFTAR URL APLIKASI

## URL Utama
- **Home/Landing Page**: `http://localhost:8000`
- **Login**: `http://localhost:8000/login`
- **Daftar**: `http://localhost:8000/register`

## Customer Routes
Setelah login sebagai customer:
- **Dashboard**: `http://localhost:8000/customer/dashboard`
- **Daftar Lapangan**: `http://localhost:8000/customer/fields`
- **Detail Lapangan**: `http://localhost:8000/customer/fields/{id}`
- **Form Booking**: `http://localhost:8000/customer/booking-form/{id}`
- **Riwayat Booking**: `http://localhost:8000/customer/booking-history`
- **Form Pembayaran**: `http://localhost:8000/customer/payment-form/{id}`
- **Notifikasi**: `http://localhost:8000/customer/notifications`

## Admin Routes
Setelah login sebagai admin:
- **Dashboard**: `http://localhost:8000/admin/dashboard`
- **Booking Pending**: `http://localhost:8000/admin/pending-bookings`
- **Detail Booking**: `http://localhost:8000/admin/booking-details/{id}`
- **Approve Booking**: POST to `http://localhost:8000/admin/approve-booking/{id}`
- **Reject Booking**: POST to `http://localhost:8000/admin/reject-booking/{id}`
- **Pembayaran Pending**: `http://localhost:8000/admin/pending-payments`
- **Detail Pembayaran**: `http://localhost:8000/admin/payment-details/{id}`
- **Verify Pembayaran**: POST to `http://localhost:8000/admin/verify-payment/{id}`
- **Semua Booking**: `http://localhost:8000/admin/all-bookings`

## Super Admin Routes
Setelah login sebagai super admin:
- **Dashboard**: `http://localhost:8000/superadmin/dashboard`
- **Laporan Revenue**: `http://localhost:8000/superadmin/revenue-report`
- **Laporan Transaksi**: `http://localhost:8000/superadmin/transaction-report`
- **Laporan Penggunaan**: `http://localhost:8000/superadmin/usage-report`

### Admin Management
- **Daftar Admin**: `http://localhost:8000/superadmin/admins`
- **Tambah Admin**: `http://localhost:8000/superadmin/admins/create`
- **Edit Admin**: `http://localhost:8000/superadmin/admins/{id}/edit`
- **Hapus Admin**: DELETE to `http://localhost:8000/superadmin/admins/{id}`

### Field Management
- **Daftar Lapangan**: `http://localhost:8000/superadmin/fields`
- **Tambah Lapangan**: `http://localhost:8000/superadmin/fields/create`
- **Edit Lapangan**: `http://localhost:8000/superadmin/fields/{id}/edit`
- **Hapus Lapangan**: DELETE to `http://localhost:8000/superadmin/fields/{id}`

### Schedule Management
- **Daftar Jadwal**: `http://localhost:8000/superadmin/schedules`
- **Tambah Jadwal**: `http://localhost:8000/superadmin/schedules/create`
- **Edit Jadwal**: `http://localhost:8000/superadmin/schedules/{id}/edit`
- **Hapus Jadwal**: DELETE to `http://localhost:8000/superadmin/schedules/{id}`

## Authentication Routes
- **Login**: `http://localhost:8000/login` (GET/POST)
- **Daftar**: `http://localhost:8000/register` (GET/POST)
- **Logout**: POST to `http://localhost:8000/logout`

## File Upload
- **Payment Proofs**: Disimpan di `/storage/app/public/payment-proofs/`
- **Access URL**: `http://localhost:8000/storage/payment-proofs/{filename}`

## Error Pages
- **401 Unauthorized**: Ketika tidak login
- **403 Forbidden**: Ketika tidak punya akses ke halaman
- **404 Not Found**: Ketika URL tidak ditemukan
- **500 Internal Server Error**: Ketika ada error di server

## Testing URLs

### Test dengan Demo Account 1 (Customer)
1. Buka `http://localhost:8000/login`
2. Email: `customer@example.com`
3. Password: `123456`
4. Klik Login
5. Akan redirect ke `http://localhost:8000/customer/dashboard`

### Test dengan Demo Account 2 (Admin)
1. Buka `http://localhost:8000/login`
2. Email: `admin@example.com`
3. Password: `123456`
4. Klik Login
5. Akan redirect ke `http://localhost:8000/admin/dashboard`

### Test dengan Demo Account 3 (Super Admin)
1. Buka `http://localhost:8000/login`
2. Email: `superadmin@example.com`
3. Password: `123456`
4. Klik Login
5. Akan redirect ke `http://localhost:8000/superadmin/dashboard`

## API Response Format

Semua response menggunakan JSON dengan format standar:

### Success Response
```json
{
    "success": true,
    "message": "Operation successful",
    "data": { ... }
}
```

### Error Response
```json
{
    "success": false,
    "message": "Error message",
    "errors": { ... }
}
```

## Pagination

Untuk halaman yang menampilkan list data (booking, payment, dll):
- Default items per page: 15
- Query parameter: `?page=1`
- Contoh: `http://localhost:8000/admin/all-bookings?page=2`

## Filtering & Searching

### Admin - All Bookings
- Filter by status: `?status=pending`
- Filter by date: `?date=2025-12-12`
- Search by user: `?search=john`

### Super Admin - Admins
- Search: `?search=name`

### Super Admin - Schedules
- Filter by field: `?field_id=1`

## Notes

- Semua waktu menggunakan format 24 jam (HH:MM)
- Tanggal menggunakan format YYYY-MM-DD
- Currency menggunakan IDR (Rp)
- Timezone: Asia/Jakarta (bisa disesuaikan di config)
