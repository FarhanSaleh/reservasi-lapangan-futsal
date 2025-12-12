# Quick Start Guide - Futsal Reservation System

## 🚀 Getting Started (5 minutes)

### Step 1: Initial Setup

```bash
# Navigate to project directory
cd c:\laragon\www\reservasi-lapangan-futsal

# Install dependencies
composer install

# Copy environment file
copy .env.example .env

# Generate app key
php artisan key:generate

# Create database
mysql -u root -p -e "CREATE DATABASE futsal_reservation;"

# Run migrations
php artisan migrate

# Create storage symlink for file uploads
php artisan storage:link
```

### Step 2: Start the Application

```bash
php artisan serve
```

Visit: `http://localhost:8000`

---

## 👤 User Types & Login

### 1. **Customer (User)**
Register a new account OR use:
- Email: customer@futsal.com
- Password: password123

**Dashboard URL**: `/customer/dashboard`

**Available Features**:
- Browse futsal fields
- Check availability by date/time
- Make reservations
- Upload payment proof
- View booking history
- Receive notifications

### 2. **Admin**
Create via Super Admin OR use:
- Email: admin@futsal.com
- Password: password123

**Dashboard URL**: `/admin/dashboard`

**Available Features**:
- Review pending bookings
- View payment proofs
- Approve/Reject reservations
- Verify/Reject payments
- View all bookings

### 3. **Super Admin**
Create initial account via direct database OR use:
- Email: superadmin@futsal.com
- Password: password123

**Dashboard URL**: `/superadmin/dashboard`

**Available Features**:
- Manage admin accounts (CRUD)
- Manage fields (CRUD)
- Manage schedules (CRUD)
- View reports (Revenue, Transactions, Usage)

---

## 📋 User Journey Examples

### Customer Booking Process

```
1. Register/Login
   ↓
2. Browse Fields (GET /customer/fields)
   ↓
3. Check Availability (GET /customer/field/{id})
   ↓
4. Make Booking (POST /customer/booking)
   ↓
5. Upload Payment (POST /customer/payment/{id})
   ↓
6. Wait for Admin Approval
   ↓
7. Receive Notification
   ↓
8. View Booking Status (GET /customer/booking-history)
```

### Admin Approval Process

```
1. Login to Admin Dashboard
   ↓
2. View Pending Bookings (GET /admin/pending-bookings)
   ↓
3. Review Booking Details
   ↓
4. Check Payment Proof (GET /admin/payment/{id})
   ↓
5. Approve/Reject Booking (POST /admin/booking/{id}/approve)
   ↓
6. Customer Receives Notification
```

### Super Admin Setup

```
1. Login to Super Admin Dashboard
   ↓
2. Add Futsal Fields (POST /superadmin/fields)
   ↓
3. Set Operating Hours (POST /superadmin/schedules)
   ↓
4. Create Admin Accounts (POST /superadmin/admins)
   ↓
5. Monitor Reports (GET /superadmin/*/report)
```

---

## 🔑 Key Features by Role

### Customer
✅ Registration & Login
✅ Field Browsing
✅ Availability Checking
✅ Booking Creation
✅ Payment Upload
✅ Booking History
✅ Notifications

### Admin
✅ Dashboard Overview
✅ Pending Bookings Review
✅ Payment Verification
✅ Approve/Reject Actions
✅ All Bookings View
✅ Status Tracking

### Super Admin
✅ Admin Management (Create/Edit/Delete)
✅ Field Management (CRUD)
✅ Schedule Management (CRUD)
✅ Revenue Reports
✅ Transaction Reports
✅ Field Usage Reports

---

## 📁 Important File Locations

```
laravel/
├── routes/web.php          ← All routes defined here
├── app/Http/Controllers/   ← Controller logic
│   ├── Auth/               ← Authentication
│   ├── Customer/           ← Customer features
│   ├── Admin/              ← Admin features
│   └── SuperAdmin/         ← Super Admin features
├── app/Models/             ← Database models
├── database/migrations/    ← Database schema
└── resources/views/        ← Blade templates
```

---

## 🔄 Database Tables

| Table | Purpose |
|-------|---------|
| users | User accounts & roles |
| fields | Futsal field information |
| schedules | Operating hours & pricing |
| bookings | Reservations |
| payments | Payment records & proofs |
| notifications | User notifications |
| reports | Generated reports |

---

## 🛡️ Security

- **Authentication**: Built-in Laravel auth
- **Authorization**: Role-based middleware
- **CSRF Protection**: Automatic in forms
- **Password**: Bcrypt hashing
- **File Upload**: Validated & stored securely

---

## 📝 Common Tasks

### Create New Field
1. Login as Super Admin
2. Go to `/superadmin/fields`
3. Click "Add New Field"
4. Fill form and submit

### Set Operating Schedule
1. Login as Super Admin
2. Go to `/superadmin/schedules`
3. Click "Add New Schedule"
4. Select field, day, time, price

### Create Admin User
1. Login as Super Admin
2. Go to `/superadmin/admins`
3. Click "Add New Admin"
4. Fill email, password, name

### Review Payment
1. Login as Admin
2. Go to `/admin/pending-payments`
3. Click "Review"
4. View proof image
5. Approve or Reject

### Generate Report
1. Login as Super Admin
2. Choose report type:
   - `/superadmin/revenue-report`
   - `/superadmin/transaction-report`
   - `/superadmin/usage-report`
3. Select date range
4. View results

---

## 🐛 Troubleshooting

### Database Connection Error
```bash
# Check .env settings
# Verify database exists
mysql -u root -p -e "SHOW DATABASES;"
```

### Storage Permission Error
```bash
# Fix permissions
php artisan storage:link
chmod -R 775 storage bootstrap/cache
```

### Routes Not Found
```bash
# Clear cache
php artisan route:clear
php artisan config:clear
php artisan cache:clear
```

### Migrations Failed
```bash
# Rollback and retry
php artisan migrate:rollback
php artisan migrate
```

---

## 📞 Support

Refer to detailed documentation:
- `README.md` - Full project documentation
- `API_DOCUMENTATION.md` - API & controller reference

---

## ✨ Next Steps

1. ✅ Complete initial setup
2. ✅ Create test fields and schedules
3. ✅ Test customer booking flow
4. ✅ Test admin approval process
5. ✅ Generate reports
6. 📌 Implement email notifications (optional)
7. 📌 Add payment gateway integration (optional)
8. 📌 Build mobile app API endpoints (optional)

---

**Happy booking! 🎉**
