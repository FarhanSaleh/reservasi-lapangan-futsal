# Futsal Reservation System - API & Implementation Guide

## Overview

This document provides detailed information about the system's controllers, models, and implementation patterns.

## Models & Relationships

### User Model
```php
// Relationships
- bookings() - One-to-many relationship with Bookings
- verifiedPayments() - One-to-many relationship with Payments (as verified_by)

// Methods
- isAdmin() - Check if user is admin or super_admin
- isSuperAdmin() - Check if user is super_admin
- isCustomer() - Check if user is customer
```

### Field Model
```php
// Relationships
- schedules() - One-to-many relationship with Schedules
- bookings() - One-to-many relationship with Bookings

// Methods
- isAvailable($date, $startTime, $endTime) - Check if field is available for booking
```

### Booking Model
```php
// Relationships
- user() - Belongs-to User
- field() - Belongs-to Field
- payment() - Has-one Payment
- notifications() - One-to-many relationship with Notifications

// Attributes
- status: pending, confirmed, rejected, completed
```

### Payment Model
```php
// Relationships
- booking() - Belongs-to Booking
- verifiedBy() - Belongs-to User (verified_by)

// Attributes
- status: pending, verified, rejected
```

## Controller Methods Reference

### AuthController

#### showLogin()
- **Route**: GET /login
- **Description**: Display login form
- **Returns**: View auth.login

#### showRegister()
- **Route**: GET /register
- **Description**: Display registration form
- **Returns**: View auth.register

#### login(Request $request)
- **Route**: POST /login
- **Description**: Handle user login
- **Validation**: email (required|email), password (required|min:6)
- **Logic**: Authenticates user, redirects based on role
- **Redirects**: 
  - super_admin → superadmin.dashboard
  - admin → admin.dashboard
  - user → customer.dashboard

#### register(Request $request)
- **Route**: POST /register
- **Description**: Handle user registration
- **Validation**: 
  - name (required|string|max:255)
  - email (required|email|unique:users)
  - password (required|min:6|confirmed)
  - phone (required|max:20)
- **Creates**: User with role='user'
- **Redirects**: customer.dashboard

#### logout(Request $request)
- **Route**: POST /logout
- **Description**: Log out user
- **Actions**: Invalidates session, regenerates token
- **Redirects**: home

### Customer DashboardController

#### index()
- **Route**: GET /customer/dashboard
- **Description**: Show customer dashboard with statistics
- **Returns**: 
  - stats (total_bookings, pending_bookings, confirmed_bookings, unread_notifications)
  - recentBookings (5 most recent)

#### fields(Request $request)
- **Route**: GET /customer/fields
- **Description**: Show available fields filtered by date
- **Parameters**: date (from request)
- **Returns**: All active fields with availability for selected date

#### fieldDetails($fieldId, Request $request)
- **Route**: GET /customer/field/{fieldId}
- **Description**: Show field details and available time slots
- **Parameters**: fieldId, date (from request)
- **Returns**: Field info, booking conflicts, available time slots

#### showBookingForm($fieldId, Request $request)
- **Route**: GET /customer/booking/form/{fieldId}
- **Description**: Display booking form
- **Parameters**: fieldId, date, start_time (from request)
- **Returns**: Booking form with pre-filled data

#### storeBooking(Request $request)
- **Route**: POST /customer/booking
- **Description**: Create new booking
- **Validation**:
  - field_id (required|exists:fields,id)
  - booking_date (required|date|after:today)
  - start_time (required|date_format:H:i)
  - end_time (required|date_format:H:i|after:start_time)
  - customer_name (required|string|max:255)
  - customer_phone (required|string|max:20)
  - notes (nullable|string)
- **Logic**:
  - Check field availability
  - Calculate total price
  - Create booking with status='pending'
  - Create payment record
- **Redirects**: customer.payment-form

#### showPaymentForm($bookingId)
- **Route**: GET /customer/payment/{bookingId}
- **Description**: Display payment proof upload form
- **Parameters**: bookingId
- **Authorization**: User must own the booking
- **Returns**: Booking summary and file upload form

#### storePaymentProof($bookingId, Request $request)
- **Route**: POST /customer/payment/{bookingId}
- **Description**: Store payment proof file
- **Validation**: payment_proof (required|image|mimes:jpeg,png,jpg|max:2048)
- **Actions**:
  - Store image in storage/payment-proofs
  - Update payment record with file path
  - Create notification
- **Redirects**: customer.booking-history

#### bookingHistory(Request $request)
- **Route**: GET /customer/booking-history
- **Description**: Show user's booking history
- **Parameters**: status (optional filter)
- **Returns**: Paginated bookings with filters

#### notifications()
- **Route**: GET /customer/notifications
- **Description**: Show user notifications
- **Returns**: Paginated notifications ordered by date

#### markNotificationRead($notificationId)
- **Route**: POST /customer/notification/{notificationId}/read
- **Description**: Mark notification as read
- **Actions**: Update notification is_read = true

### Admin DashboardController

#### index()
- **Route**: GET /admin/dashboard
- **Description**: Show admin dashboard with statistics
- **Returns**:
  - stats (pending_bookings, pending_payments, confirmed_bookings, total_revenue)
  - pendingBookings (10 most recent)
  - pendingPayments (10 most recent)

#### pendingBookings(Request $request)
- **Route**: GET /admin/pending-bookings
- **Description**: Show pending bookings
- **Parameters**: sort_by (created_at|booking_date)
- **Returns**: Paginated pending bookings

#### bookingDetails($bookingId)
- **Route**: GET /admin/booking/{bookingId}
- **Description**: Show booking details with options to approve/reject
- **Returns**: Complete booking information, customer details, booking details

#### approveBooking($bookingId, Request $request)
- **Route**: POST /admin/booking/{bookingId}/approve
- **Description**: Approve pending booking
- **Actions**:
  - Update booking status to 'confirmed'
  - Update payment status to 'verified'
  - Create approval notification
- **Redirects**: admin.pending-bookings

#### rejectBooking($bookingId, Request $request)
- **Route**: POST /admin/booking/{bookingId}/reject
- **Description**: Reject pending booking
- **Validation**: rejection_reason (required|string|max:500)
- **Actions**:
  - Update booking status to 'rejected'
  - Update payment status to 'rejected'
  - Create rejection notification with reason
- **Redirects**: admin.pending-bookings

#### pendingPayments(Request $request)
- **Route**: GET /admin/pending-payments
- **Description**: Show pending payments
- **Parameters**: sort_by (created_at|amount)
- **Returns**: Paginated pending payments

#### paymentDetails($paymentId)
- **Route**: GET /admin/payment/{paymentId}
- **Description**: Show payment details with proof image
- **Returns**: Booking info, payment info, proof image

#### verifyPayment($paymentId, Request $request)
- **Route**: POST /admin/payment/{paymentId}/verify
- **Description**: Verify and approve payment
- **Actions**:
  - Update payment status to 'verified'
  - Update booking status to 'confirmed'
  - Create approval notification
- **Redirects**: admin.pending-payments

#### rejectPayment($paymentId, Request $request)
- **Route**: POST /admin/payment/{paymentId}/reject
- **Description**: Reject payment
- **Validation**: rejection_reason (required|string|max:500)
- **Actions**:
  - Update payment status to 'rejected'
  - Update booking status to 'rejected'
  - Create rejection notification
- **Redirects**: admin.pending-payments

#### allBookings(Request $request)
- **Route**: GET /admin/all-bookings
- **Description**: Show all bookings with filters
- **Parameters**: status (optional), field_id (optional)
- **Returns**: Paginated bookings with filters applied

### SuperAdmin DashboardController

#### index()
- **Route**: GET /superadmin/dashboard
- **Description**: Show super admin dashboard with system statistics
- **Returns**:
  - stats (total_users, total_admins, total_fields, total_bookings, total_revenue, pending_payments)
  - recentBookings (5 most recent)

#### revenueReport(Request $request)
- **Route**: GET /superadmin/revenue-report
- **Description**: Generate revenue report
- **Parameters**: start_date, end_date
- **Returns**: Total revenue, breakdown by booking

#### transactionReport(Request $request)
- **Route**: GET /superadmin/transaction-report
- **Description**: Generate transaction report
- **Parameters**: start_date, end_date
- **Returns**: Payment status summary, detailed transactions

#### usageReport(Request $request)
- **Route**: GET /superadmin/usage-report
- **Description**: Generate field usage report
- **Parameters**: start_date, end_date
- **Returns**: Field usage summary, booking details

### SuperAdmin AdminController

#### index(Request $request)
- **Route**: GET /superadmin/admins
- **Description**: List all admins
- **Parameters**: search (name/email search)
- **Returns**: Paginated admin list

#### create()
- **Route**: GET /superadmin/admins/create
- **Description**: Show create admin form
- **Returns**: Admin creation form

#### store(Request $request)
- **Route**: POST /superadmin/admins
- **Description**: Create new admin
- **Validation**:
  - name (required|string|max:255)
  - email (required|email|unique:users)
  - password (required|min:6|confirmed)
  - phone (nullable|string|max:20)
- **Creates**: User with role='admin'

#### edit($adminId)
- **Route**: GET /superadmin/admins/{adminId}/edit
- **Description**: Show edit admin form
- **Returns**: Admin editing form with current data

#### update($adminId, Request $request)
- **Route**: PUT /superadmin/admins/{adminId}
- **Description**: Update admin details
- **Validation**: Similar to store with email uniqueness exception
- **Logic**: Updates password only if provided

#### delete($adminId)
- **Route**: DELETE /superadmin/admins/{adminId}
- **Description**: Delete admin account

### SuperAdmin FieldController

#### index(Request $request)
- **Route**: GET /superadmin/fields
- **Description**: List all fields
- **Parameters**: search (name/location search)
- **Returns**: Paginated field list

#### create()
- **Route**: GET /superadmin/fields/create
- **Description**: Show create field form

#### store(Request $request)
- **Route**: POST /superadmin/fields
- **Description**: Create new field
- **Validation**:
  - name (required|string|max:255)
  - description (nullable|string)
  - location (required|string|max:255)
  - facilities (nullable|json)
  - price_per_hour (required|numeric|min:0)
  - is_active (boolean)

#### edit($fieldId)
- **Route**: GET /superadmin/fields/{fieldId}/edit
- **Description**: Show edit field form

#### update($fieldId, Request $request)
- **Route**: PUT /superadmin/fields/{fieldId}
- **Description**: Update field details

#### delete($fieldId)
- **Route**: DELETE /superadmin/fields/{fieldId}
- **Description**: Delete field

### SuperAdmin ScheduleController

#### index(Request $request)
- **Route**: GET /superadmin/schedules
- **Description**: List all schedules
- **Parameters**: field_id (optional filter)
- **Returns**: Paginated schedule list

#### create()
- **Route**: GET /superadmin/schedules/create
- **Description**: Show create schedule form
- **Returns**: All fields for selection

#### store(Request $request)
- **Route**: POST /superadmin/schedules
- **Description**: Create new schedule
- **Validation**:
  - field_id (required|exists:fields,id)
  - day_of_week (required|integer|between:0,6)
  - open_time (required|date_format:H:i)
  - close_time (required|date_format:H:i|after:open_time)
  - price_per_hour (required|numeric|min:0)

#### edit($scheduleId)
- **Route**: GET /superadmin/schedules/{scheduleId}/edit
- **Description**: Show edit schedule form

#### update($scheduleId, Request $request)
- **Route**: PUT /superadmin/schedules/{scheduleId}
- **Description**: Update schedule details

#### delete($scheduleId)
- **Route**: DELETE /superadmin/schedules/{scheduleId}
- **Description**: Delete schedule

## Middleware

### CheckRole
- **Usage**: `middleware('check.role:admin,super_admin')`
- **Function**: Validates user has required role
- **Action**: Redirects to 403 if unauthorized

### CheckActive
- **Usage**: `middleware('check.active')`
- **Function**: Ensures user account is active
- **Action**: Logs out user if inactive

## Common Patterns

### Availability Checking
```php
$field->isAvailable($date, $startTime, $endTime)
```

### Price Calculation
```php
$hours = $startTime->diffInHours($endTime);
$totalPrice = $hours * $field->price_per_hour;
```

### Notification Creation
```php
Notification::create([
    'booking_id' => $booking->id,
    'user_id' => $user->id,
    'type' => 'approved|pending|rejected',
    'title' => 'Title',
    'message' => 'Message'
]);
```

## Error Handling

- 403 Unauthorized: When user lacks required role
- 404 Not Found: When resource doesn't exist
- 422 Unprocessable Entity: When validation fails

## Future API Endpoints

These can be implemented as REST API endpoints:

- `GET /api/fields` - Get all fields
- `GET /api/fields/{id}/availability` - Check availability
- `POST /api/bookings` - Create booking (mobile apps)
- `GET /api/bookings/{id}` - Get booking details
- `PUT /api/payments/{id}/verify` - Verify payment (admin API)

