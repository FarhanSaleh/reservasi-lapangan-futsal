# Futsal Reservation System - Complete Documentation

## Project Overview

A comprehensive Laravel-based futsal field reservation system with role-based access control for three user types: Customers (Users), Admins, and Super Admins.

## User Roles & Features

### 1. **User (Customer)**
- **Authentication**: Register and login
- **Field Browsing**: View all available futsal fields with details
- **Availability Checking**: Check field availability by date and time
- **Booking Management**: 
  - Make reservations
  - Fill booking forms
  - Upload payment proof
  - View booking history
  - Track booking status
- **Notifications**: Receive status updates (pending, approved, rejected)

### 2. **Admin**
- **Authentication**: Login to the system
- **Booking Management**:
  - View pending bookings
  - Review booking details
  - Approve or reject reservations
  - Manage booking status
- **Payment Verification**:
  - Review pending payments
  - Check payment proofs
  - Verify or reject payments
  - Track payment status
- **Field Management**: View field schedules and availability
- **Booking History**: View all bookings with filters

### 3. **Super Admin**
- **Admin Management**: 
  - Create, edit, and delete admin accounts
  - Manage admin status (active/inactive)
- **Field Management**: 
  - Add, edit, and delete futsal fields
  - Manage field details and facilities
- **Schedule Management**:
  - Set operating hours
  - Configure pricing per field/day
- **System Configuration**: Overall system settings
- **Reporting**:
  - Revenue reports (by date range)
  - Transaction reports (payment status tracking)
  - Field usage reports (booking statistics)
- **Admin Functions**: Can perform all admin tasks if needed

## Database Schema

### Tables

1. **users**
   - id, name, email, password, phone, role (user/admin/super_admin), is_active
   - Timestamps

2. **fields**
   - id, name, description, location, facilities (JSON), price_per_hour, is_active
   - Timestamps

3. **schedules**
   - id, field_id, day_of_week (0-6), open_time, close_time, price_per_hour
   - Timestamps

4. **bookings**
   - id, user_id, field_id, booking_date, start_time, end_time
   - customer_name, customer_phone, notes
   - status (pending/confirmed/rejected/completed), total_price
   - Timestamps

5. **payments**
   - id, booking_id, amount, payment_proof_path
   - status (pending/verified/rejected)
   - verified_by (admin_id), verified_at, notes
   - Timestamps

6. **notifications**
   - id, booking_id, user_id
   - type (pending/approved/rejected), title, message, is_read
   - Timestamps

7. **reports**
   - id, type (transaction/revenue/usage)
   - period_start, period_end, data (JSON), generated_by, generated_at
   - Timestamps

## File Structure

```
laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   └── AuthController.php
│   │   │   ├── Customer/
│   │   │   │   └── DashboardController.php
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   └── BookingController.php
│   │   │   └── SuperAdmin/
│   │   │       ├── DashboardController.php
│   │   │       ├── AdminController.php
│   │   │       ├── FieldController.php
│   │   │       └── ScheduleController.php
│   │   ├── Middleware/
│   │   │   ├── CheckRole.php
│   │   │   └── CheckActive.php
│   │   └── Kernel.php
│   └── Models/
│       ├── User.php
│       ├── Field.php
│       ├── Schedule.php
│       ├── Booking.php
│       ├── Payment.php
│       ├── Notification.php
│       └── Report.php
├── database/
│   └── migrations/
│       ├── 2025_12_12_000001_create_users_table.php
│       ├── 2025_12_12_000002_create_fields_table.php
│       ├── 2025_12_12_000003_create_schedules_table.php
│       ├── 2025_12_12_000004_create_bookings_table.php
│       ├── 2025_12_12_000005_create_payments_table.php
│       ├── 2025_12_12_000006_create_notifications_table.php
│       └── 2025_12_12_000007_create_reports_table.php
├── resources/
│   └── views/
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── layouts/
│       │   ├── auth.blade.php
│       │   ├── customer.blade.php
│       │   ├── admin.blade.php
│       │   └── superadmin.blade.php
│       ├── customer/
│       │   ├── dashboard.blade.php
│       │   ├── fields.blade.php
│       │   ├── field-details.blade.php
│       │   ├── booking-form.blade.php
│       │   ├── payment-form.blade.php
│       │   ├── booking-history.blade.php
│       │   └── notifications.blade.php
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── pending-bookings.blade.php
│       │   ├── booking-details.blade.php
│       │   ├── pending-payments.blade.php
│       │   ├── payment-details.blade.php
│       │   └── all-bookings.blade.php
│       ├── superadmin/
│       │   ├── dashboard.blade.php
│       │   ├── admins/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   └── edit.blade.php
│       │   ├── fields/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   └── edit.blade.php
│       │   ├── schedules/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   └── edit.blade.php
│       │   ├── revenue-report.blade.php
│       │   ├── transaction-report.blade.php
│       │   └── usage-report.blade.php
│       ├── errors/
│       │   └── unauthorized.blade.php
│       └── index.blade.php
├── routes/
│   └── web.php
└── middleware.php
```

## Routes Overview

### Public Routes
- `GET /` - Home page
- `GET /login` - Login form
- `POST /login` - Login submission
- `GET /register` - Registration form
- `POST /register` - Registration submission

### Customer Routes (`/customer`)
- `GET /dashboard` - Customer dashboard
- `GET /fields` - Browse available fields
- `GET /field/{fieldId}` - View field details
- `GET /booking/form/{fieldId}` - Booking form
- `POST /booking` - Create booking
- `GET /payment/{bookingId}` - Payment upload form
- `POST /payment/{bookingId}` - Upload payment proof
- `GET /booking-history` - View booking history
- `GET /notifications` - View notifications
- `POST /notification/{notificationId}/read` - Mark as read

### Admin Routes (`/admin`)
- `GET /dashboard` - Admin dashboard
- `GET /pending-bookings` - Pending bookings list
- `GET /booking/{bookingId}` - Booking details
- `POST /booking/{bookingId}/approve` - Approve booking
- `POST /booking/{bookingId}/reject` - Reject booking
- `GET /pending-payments` - Pending payments list
- `GET /payment/{paymentId}` - Payment details
- `POST /payment/{paymentId}/verify` - Verify payment
- `POST /payment/{paymentId}/reject` - Reject payment
- `GET /all-bookings` - All bookings with filters

### Super Admin Routes (`/superadmin`)
- `GET /dashboard` - Super admin dashboard
- `GET /admins` - List admins
- `GET /admins/create` - Create admin form
- `POST /admins` - Store new admin
- `GET /admins/{adminId}/edit` - Edit admin
- `PUT /admins/{adminId}` - Update admin
- `DELETE /admins/{adminId}` - Delete admin
- `GET /fields` - List fields
- `GET /fields/create` - Create field form
- `POST /fields` - Store field
- `GET /fields/{fieldId}/edit` - Edit field
- `PUT /fields/{fieldId}` - Update field
- `DELETE /fields/{fieldId}` - Delete field
- `GET /schedules` - List schedules
- `GET /schedules/create` - Create schedule form
- `POST /schedules` - Store schedule
- `GET /schedules/{scheduleId}/edit` - Edit schedule
- `PUT /schedules/{scheduleId}` - Update schedule
- `DELETE /schedules/{scheduleId}` - Delete schedule
- `GET /revenue-report` - Revenue report
- `GET /transaction-report` - Transaction report
- `GET /usage-report` - Usage report

## Setup Instructions

### Prerequisites
- PHP 8.0+
- Laravel 10+
- MySQL/PostgreSQL
- Composer

### Installation Steps

1. **Clone the repository**
```bash
cd c:\laragon\www\reservasi-lapangan-futsal
```

2. **Install dependencies**
```bash
composer install
```

3. **Setup environment file**
```bash
cp .env.example .env
```

4. **Generate application key**
```bash
php artisan key:generate
```

5. **Configure database in `.env`**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=futsal_reservation
DB_USERNAME=root
DB_PASSWORD=
```

6. **Create database**
```bash
mysql -u root -p -e "CREATE DATABASE futsal_reservation;"
```

7. **Run migrations**
```bash
php artisan migrate
```

8. **Create storage symlink**
```bash
php artisan storage:link
```

9. **Seed initial data (optional)**
```bash
php artisan db:seed
```

10. **Start the application**
```bash
php artisan serve
```

Access the application at `http://localhost:8000`

## Default Test Accounts

Create these accounts through the application or via seeder:

### Super Admin
- Email: superadmin@futsal.com
- Password: password123

### Admin
- Email: admin@futsal.com
- Password: password123

### Customer
- Email: customer@futsal.com
- Password: password123

## Key Features Implementation

### 1. Role-Based Access Control
- Middleware `CheckRole` validates user permissions
- Three roles: user, admin, super_admin
- Routes protected by role-based middleware

### 2. Booking System
- Check field availability before booking
- Calculate total price based on duration
- Prevent overlapping bookings
- Status tracking: pending → confirmed → completed

### 3. Payment Management
- Users upload payment proof
- Admins verify and approve payments
- Automatic notification to users
- Payment status tracking

### 4. Notification System
- Real-time status updates
- Email notifications (can be implemented)
- Mark notifications as read

### 5. Reporting
- Revenue reports by date range
- Transaction history with status
- Field usage statistics
- Booking analytics

## Security Features

- Password hashing using bcrypt
- CSRF token protection
- SQL injection prevention via Eloquent ORM
- Middleware authentication checks
- Role-based authorization
- Account active/inactive status checking

## Future Enhancements

1. Email notifications
2. Payment gateway integration (Stripe, PayPal)
3. SMS notifications
4. API endpoints for mobile apps
5. Advanced analytics dashboard
6. Cancellation and refund policies
7. Multi-language support
8. Real-time availability updates
9. Rating and review system
10. Promotional codes and discounts

## Support & Maintenance

For technical support, please contact the development team or refer to Laravel documentation at https://laravel.com

## License

This project is licensed under the MIT License.
