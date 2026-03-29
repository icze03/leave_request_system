# Leave Request System

A role-based leave management web application built with **Laravel 12** and **Laravel Breeze**. The system provides separate workflows for employees and administrators, including account approval gating, leave request lifecycle management, and a filterable admin dashboard.

---

## Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Requirements](#requirements)
- [Installation](#installation)
- [Environment Configuration](#environment-configuration)
- [Database](#database)
- [Running the Application](#running-the-application)
- [Project Structure](#project-structure)
- [Roles & Access Control](#roles--access-control)
- [Routes Reference](#routes-reference)
- [Data Models](#data-models)
- [Middleware](#middleware)
- [Contributing](#contributing)
- [License](#license)

---

## Features

### Employee (User)
- Register and log in via Laravel Breeze authentication
- Submit leave requests with type (Vacation, Sick, Emergency), date range, and reason
- View personal leave request history with status tracking
- View individual leave request details

### Administrator
- Dashboard with summary statistics (pending, approved, rejected counts)
- Approve or reject pending leave requests
- Manage user accounts: approve/revoke access, delete users
- Filter leave requests and users by status
- Paginated lists (10 per page) for both leave requests and users

### System
- Account approval gate — new registrations are held pending admin approval before they can log in
- Role-based middleware enforcing admin and user access boundaries
- Session-based flash messages for all actions
- SQLite out of the box (MySQL/PostgreSQL supported via `.env`)

---

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 12 |
| Auth Scaffolding | Laravel Breeze 2.x |
| PHP | 8.2+ |
| Default Database | SQLite |
| Frontend | Blade + Tailwind CSS (via Vite) |
| Queue / Cache | Database driver (default) |
| Testing | PHPUnit 11 |

---

## Requirements

- PHP >= 8.2 with extensions: `pdo`, `pdo_sqlite` (or `pdo_mysql`), `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`
- Composer >= 2.x
- Node.js >= 18 + npm >= 9

---

## Installation

```bash
# 1. Clone the repository
git clone https://github.com/your-org/leave_request_system.git
cd leave_request_system

# 2. Install PHP dependencies
composer install

# 3. Copy environment file and generate application key
cp .env.example .env
php artisan key:generate

# 4. Create the SQLite database file
touch database/database.sqlite

# 5. Run migrations
php artisan migrate

# 6. Install and build frontend assets
npm install
npm run build
```

> **One-command setup (via Composer script):**
> ```bash
> composer setup
> ```
> This runs steps 2–6 automatically.

---

## Environment Configuration

Copy `.env.example` to `.env` and adjust the values below as needed.

### SQLite (default — no extra setup required)

```env
DB_CONNECTION=sqlite
```

### MySQL / PostgreSQL

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=leave_request_system
DB_USERNAME=root
DB_PASSWORD=secret
```

### Other key variables

| Variable | Default | Description |
|---|---|---|
| `APP_NAME` | `Laravel` | Application name shown in UI |
| `APP_ENV` | `local` | `local`, `production`, etc. |
| `APP_DEBUG` | `true` | Set to `false` in production |
| `APP_URL` | `http://localhost` | Base URL of the application |
| `SESSION_DRIVER` | `database` | Session storage backend |
| `QUEUE_CONNECTION` | `database` | Queue driver |
| `CACHE_STORE` | `database` | Cache driver |
| `MAIL_MAILER` | `log` | Mail driver (change for real email) |

---

## Database

### Migrations

| File | Description |
|---|---|
| `0001_01_01_000000_create_users_table.php` | Core users table |
| `0001_01_01_000001_create_cache_table.php` | Cache table |
| `0001_01_01_000002_create_jobs_table.php` | Queue jobs table |
| `2026_02_02_004059_add_role_to_users_table.php` | Adds `role` column (`user` \| `admin`) |
| `2026_02_02_004159_create_leave_requests_table.php` | Leave requests table |
| `2026_02_02_011123_add_is_approved_to_users_table.php` | Adds `is_approved` boolean column |

### Schema Overview

**users**

| Column | Type | Notes |
|---|---|---|
| `id` | bigint | Primary key |
| `name` | string | Full name |
| `email` | string | Unique |
| `password` | string | Hashed (bcrypt) |
| `role` | string | `user` or `admin`, default `user` |
| `is_approved` | boolean | Default `false`; must be set `true` by admin |
| `email_verified_at` | timestamp | Nullable |
| `remember_token` | string | Nullable |
| `created_at` / `updated_at` | timestamp | Auto-managed |

**leave_requests**

| Column | Type | Notes |
|---|---|---|
| `id` | bigint | Primary key |
| `user_id` | bigint | FK → users (cascade delete) |
| `leave_type` | string | `Vacation`, `Sick`, or `Emergency` |
| `start_date` | date | Must be today or future |
| `end_date` | date | Must be ≥ start_date |
| `reason` | text | 10–500 characters |
| `status` | enum | `Pending` (default), `Approved`, `Rejected` |
| `created_at` / `updated_at` | timestamp | Auto-managed |

---

## Running the Application

### Development (all-in-one)

```bash
composer dev
```

Starts: Laravel dev server, queue worker, Pail log viewer, and Vite HMR concurrently.

### Individual services

```bash
php artisan serve          # Web server at http://localhost:8000
npm run dev                # Vite dev server with HMR
php artisan queue:listen   # Queue worker
```

### Running Tests

```bash
composer test
# or
php artisan test
```

---

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── DashboardController.php       # Admin dashboard stats
│   │   │   ├── LeaveRequestController.php    # Approve / reject leave requests
│   │   │   └── UserManagementController.php  # Approve / reject / delete users
│   │   ├── Auth/                             # Breeze auth controllers
│   │   ├── User/
│   │   │   ├── DashboardController.php       # User dashboard
│   │   │   └── LeaveRequestController.php    # Submit & view leave requests
│   │   └── ProfileController.php
│   ├── Middleware/
│   │   ├── AdminMiddleware.php               # Enforces admin role
│   │   ├── EnsureUserIsApproved.php          # Blocks unapproved users after login
│   │   └── UserMiddleware.php                # Enforces user role
│   └── Requests/
│       └── Auth/LoginRequest.php
├── Models/
│   ├── User.php                              # Roles, approval, hasMany leaveRequests
│   └── LeaveRequest.php                      # Status scopes, days accessor
└── Providers/
    └── AppServiceProvider.php

database/
├── migrations/
├── factories/
└── seeders/

resources/views/
├── admin/
│   ├── dashboard.blade.php
│   ├── leave-requests/index.blade.php
│   └── users/index.blade.php
├── auth/                                     # Breeze auth views
├── components/                               # Reusable Blade components
├── layouts/
│   ├── app.blade.php
│   └── guest.blade.php
└── user/
    └── leave-requests/
        ├── create.blade.php
        ├── index.blade.php
        └── show.blade.php

routes/
├── web.php                                   # Application routes
└── auth.php                                  # Breeze auth routes
```

---

## Roles & Access Control

The system has two roles assigned via the `role` column on the `users` table.

| Role | Value | Dashboard | Leave Requests | User Management |
|---|---|---|---|---|
| Employee | `user` | `/user/dashboard` | Submit & view own | ✗ |
| Administrator | `admin` | `/admin/dashboard` | Approve / reject all | Full CRUD |

### Account Approval Flow

1. User registers → `is_approved` defaults to `false`.
2. User attempts login → `EnsureUserIsApproved` middleware checks `is_approved`.
3. If not approved, the user is logged out and redirected with an error message.
4. Admin navigates to **User Management**, finds the pending user, and clicks **Approve**.
5. User can now log in and access the system.

Admins bypass the approval check entirely.

---

## Routes Reference

### Public

| Method | URI | Description |
|---|---|---|
| GET | `/` | Welcome page |
| GET | `/login` | Login form |
| POST | `/login` | Authenticate |
| GET | `/register` | Registration form |
| POST | `/register` | Create account |
| POST | `/logout` | Log out |

### Authenticated + Approved (`auth`, `approved` middleware)

| Method | URI | Description |
|---|---|---|
| GET | `/profile` | Edit profile |
| PATCH | `/profile` | Update profile |
| DELETE | `/profile` | Delete account |

### Admin (`admin` middleware, prefix `/admin`)

| Method | URI | Name | Description |
|---|---|---|---|
| GET | `/admin/dashboard` | `admin.dashboard` | Dashboard stats |
| GET | `/admin/users` | `admin.users.index` | User list (filterable) |
| POST | `/admin/users/{user}/approve` | `admin.users.approve` | Approve user |
| POST | `/admin/users/{user}/reject` | `admin.users.reject` | Revoke user access |
| DELETE | `/admin/users/{user}` | `admin.users.destroy` | Delete user |
| GET | `/admin/leave-requests` | `admin.leave-requests.index` | Leave request list |
| POST | `/admin/leave-requests/{leaveRequest}/approve` | `admin.leave-requests.approve` | Approve request |
| POST | `/admin/leave-requests/{leaveRequest}/reject` | `admin.leave-requests.reject` | Reject request |

### User (`user` middleware, prefix `/user`)

| Method | URI | Name | Description |
|---|---|---|---|
| GET | `/user/dashboard` | `user.dashboard` | User dashboard |
| GET | `/user/leave-requests` | `user.leave-requests.index` | My requests |
| GET | `/user/leave-requests/create` | `user.leave-requests.create` | Submit form |
| POST | `/user/leave-requests` | `user.leave-requests.store` | Store request |
| GET | `/user/leave-requests/{leaveRequest}` | `user.leave-requests.show` | View request |

---

## Data Models

### `User`

```php
// Relationships
public function leaveRequests(): HasMany

// Helpers
public function isAdmin(): bool   // role === 'admin'
public function isUser(): bool    // role === 'user'
public function isApproved(): bool // is_approved === true
```

### `LeaveRequest`

```php
// Relationship
public function user(): BelongsTo

// Accessor
public function getDaysAttribute(): int  // end_date->diffInDays(start_date) + 1

// Scopes
public function scopePending($query)
public function scopeApproved($query)
public function scopeRejected($query)
```

---

## Middleware

| Class | Alias | Purpose |
|---|---|---|
| `AdminMiddleware` | `admin` | Aborts with 403 if the authenticated user is not an admin |
| `UserMiddleware` | `user` | Enforces user role on user-scoped routes |
| `EnsureUserIsApproved` | `approved` | Logs out and redirects non-approved users; admins are exempt |

---

## Contributing

1. Fork the repository and create a feature branch: `git checkout -b feature/your-feature`
2. Commit your changes following conventional commit style
3. Run the test suite: `composer test`
4. Open a pull request against `main` with a clear description of changes

Please ensure new features include appropriate tests and that `php artisan test` passes before submitting.

---

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

