# Post-Installation Checklist

## ✅ Complete Installation Tasks

This checklist ensures your futsal reservation system is fully set up and ready to use.

---

## 🔧 Step 1: Initial Configuration

- [ ] Installed all Composer dependencies: `composer install`
- [ ] Generated application key: `php artisan key:generate`
- [ ] Created `.env` file from `.env.example`
- [ ] Set `APP_KEY` in `.env`
- [ ] Configured database connection:
  - [ ] `DB_HOST=127.0.0.1` or your server
  - [ ] `DB_DATABASE=futsal_reservation`
  - [ ] `DB_USERNAME=root` (or your user)
  - [ ] `DB_PASSWORD=` (set if needed)

---

## 🗄️ Step 2: Database Setup

- [ ] Created database: `mysql -u root -p -e "CREATE DATABASE futsal_reservation;"`
- [ ] Ran migrations: `php artisan migrate`
- [ ] All 7 tables created successfully:
  - [ ] users
  - [ ] fields
  - [ ] schedules
  - [ ] bookings
  - [ ] payments
  - [ ] notifications
  - [ ] reports

---

## 📁 Step 3: File & Storage Setup

- [ ] Created storage symlink: `php artisan storage:link`
- [ ] Verified `storage/` directory exists
- [ ] Created `storage/app/public` directory
- [ ] Verified write permissions on storage directory
- [ ] Payment proof upload directory ready

---

## 🚀 Step 4: Application Verification

- [ ] Started Laravel server: `php artisan serve`
- [ ] Accessed homepage at `http://localhost:8000`
- [ ] All routes loading correctly
- [ ] No 500 errors in console

---

## 👥 Step 5: User Account Setup

Choose one of the following options:

### Option A: Create Test Accounts via Registration
- [ ] Created Customer account by registering
- [ ] Email verified (if email configured)
- [ ] Can log in as customer

### Option B: Create via Database Seeder (Optional)
- [ ] Run: `php artisan db:seed` (if seeder exists)
- [ ] Test accounts created in database

### Option C: Manual Database Insert
- [ ] Insert Super Admin account:
  ```sql
  INSERT INTO users (name, email, password, role, is_active)
  VALUES ('Super Admin', 'superadmin@futsal.com', 
          'bcrypt_hashed_password', 'super_admin', 1);
  ```
- [ ] Insert Admin account:
  ```sql
  INSERT INTO users (name, email, password, role, is_active)
  VALUES ('Admin', 'admin@futsal.com', 
          'bcrypt_hashed_password', 'admin', 1);
  ```

---

## 🏢 Step 6: Initial Data Setup (Super Admin)

Login as Super Admin (`/superadmin/dashboard`):

- [ ] Created at least 1 futsal field:
  - [ ] Field name entered
  - [ ] Location set
  - [ ] Price per hour configured
  - [ ] Status set to active

- [ ] Created schedules for the field:
  - [ ] Field selected
  - [ ] Day of week chosen
  - [ ] Operating hours set (e.g., 08:00 - 22:00)
  - [ ] Price configured

- [ ] Created admin account(s):
  - [ ] Admin name entered
  - [ ] Admin email configured
  - [ ] Strong password set
  - [ ] Account activated

---

## 🧪 Step 7: Feature Testing

### Authentication Testing
- [ ] User registration works
- [ ] User login works
- [ ] Admin login works
- [ ] Super Admin login works
- [ ] Logout works
- [ ] Session timeout works (if configured)

### Customer Features
- [ ] Can view fields
- [ ] Can check availability by date
- [ ] Can make booking
- [ ] Can fill booking form
- [ ] Can upload payment proof
- [ ] Can view booking history
- [ ] Can view notifications
- [ ] Receives status notifications

### Admin Features
- [ ] Can view pending bookings
- [ ] Can review booking details
- [ ] Can approve bookings
- [ ] Can reject bookings
- [ ] Can view pending payments
- [ ] Can verify payment proofs
- [ ] Can reject payments
- [ ] Can view all bookings

### Super Admin Features
- [ ] Can access admin management
- [ ] Can create new admin
- [ ] Can edit admin details
- [ ] Can deactivate admin
- [ ] Can access field management
- [ ] Can create new field
- [ ] Can edit field details
- [ ] Can access schedule management
- [ ] Can create schedule
- [ ] Can view revenue report
- [ ] Can view transaction report
- [ ] Can view usage report

---

## 🔐 Step 8: Security Verification

- [ ] CSRF tokens present in all forms
- [ ] Authentication middleware active
- [ ] Role middleware working
- [ ] Unauthorized access returns 403
- [ ] Sensitive data not exposed in logs
- [ ] File uploads only stored in public directory
- [ ] Password stored as hash (never plain text)

---

## 📋 Step 9: File Permissions

- [ ] `storage/` directory: readable and writable (755 or 775)
- [ ] `bootstrap/cache/` directory: writable (755 or 775)
- [ ] `.env` file: readable but not executable (644)
- [ ] `public/storage/` symlink created

```bash
# Set correct permissions (if needed)
chmod -R 755 storage bootstrap/cache
chmod 644 .env
```

---

## 🌐 Step 10: Environment Configuration

- [ ] APP_NAME set to "Futsal Reservation System"
- [ ] APP_URL set correctly for your environment
- [ ] APP_DEBUG set to `false` for production
- [ ] Database credentials correct
- [ ] MAIL configuration set (optional for now)
- [ ] Storage disk set to `public` for file uploads

---

## 📧 Step 11: Optional - Email Configuration

If you want to enable notifications:

- [ ] Configured MAIL_DRIVER (smtp/sendmail/mailtrap)
- [ ] Set MAIL_HOST
- [ ] Set MAIL_PORT
- [ ] Set MAIL_USERNAME
- [ ] Set MAIL_PASSWORD
- [ ] Set MAIL_FROM_ADDRESS
- [ ] Tested email sending (optional)

---

## 💳 Step 12: Optional - Payment Gateway Setup

For future payment integration:

- [ ] Registered with payment provider (Stripe, PayPal, etc.)
- [ ] Obtained API keys
- [ ] Added keys to `.env`
- [ ] Not yet integrated into system (ready for future)

---

## 📊 Step 13: Backup & Maintenance

- [ ] Database backed up
- [ ] `.env` file secured (not in version control)
- [ ] Storage directory backed up
- [ ] Created maintenance plan
- [ ] Documented admin credentials securely

---

## 🎯 Step 14: Deployment Readiness (if deploying)

- [ ] Set `APP_DEBUG=false` in production
- [ ] Set `APP_ENV=production`
- [ ] Configured production database
- [ ] Set strong `APP_KEY`
- [ ] Configured SSL certificate
- [ ] Set proper file permissions
- [ ] Configured backup system
- [ ] Tested all features in production

---

## ✨ Step 15: Documentation & Training

- [ ] Read README.md thoroughly
- [ ] Reviewed API_DOCUMENTATION.md
- [ ] Reviewed QUICK_START.md
- [ ] Shared documentation with team
- [ ] Created user manual for admins
- [ ] Created user guide for customers
- [ ] Set up support process

---

## 🚀 Step 16: Go Live Checklist

Before making the system live:

- [ ] All tests passed
- [ ] Admin trained on system
- [ ] Customer-facing information ready
- [ ] Support contact information published
- [ ] Backup system configured
- [ ] Monitoring/logging configured
- [ ] Emergency rollback plan ready
- [ ] All features verified in live environment

---

## 🆘 Troubleshooting Tips

If you encounter issues:

### Database Issues
```bash
# Check database connection
php artisan tinker
>>> DB::connection()->getPDO()

# Rerun migrations if tables missing
php artisan migrate

# Reset everything (be careful!)
php artisan migrate:fresh
```

### File Upload Issues
```bash
# Recreate storage symlink
php artisan storage:link

# Fix permissions
chmod -R 775 storage
```

### Cache Issues
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Authentication Issues
```bash
# Check users table
php artisan tinker
>>> User::all()

# Regenerate app key
php artisan key:generate
```

---

## 📞 Support Resources

- **Laravel Documentation**: https://laravel.com/docs
- **PHP Documentation**: https://www.php.net/docs.php
- **MySQL Documentation**: https://dev.mysql.com/doc
- **Project Documentation**: See README.md, API_DOCUMENTATION.md

---

## ✅ Final Sign-Off

Once all checkboxes are complete, your system is ready for use!

System Status: **READY** ✅

Installation Date: _____________
Verified By: _____________________
Notes: _____________________________

---

**Congratulations! 🎉 Your Futsal Reservation System is now live!**

For support, refer to the documentation or contact the development team.
