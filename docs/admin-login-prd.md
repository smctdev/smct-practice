# Product Requirements Spec: Simple Admin Login

## Objective

Add a simple authenticated admin area to the Laravel app so staff/admin users can access admin-only pages while regular customers cannot.

## Scope

This release adds the minimum access-control foundation for an admin interface:

- Admin-capable user accounts
- Protected `/admin` route group
- Admin dashboard placeholder
- Admin-only navigation link
- Feature tests for access behavior

This does not include full admin CRUD screens for products, orders, customers, or reports.

## Users

### Admin User

Needs to log in and access internal admin pages.

### Regular Authenticated User

Can continue using normal customer/profile features but cannot access admin pages.

### Guest User

Can browse public pages and is redirected to login when trying to access admin pages.

## Requirements

### 1. Admin User Flag

Add an `is_admin` boolean column to the `users` table.

Acceptance criteria:

- Existing users default to `is_admin = false`.
- User model supports reading and writing `is_admin`.
- Local seed data marks `demo@example.com` as admin.
- No existing login/signup behavior breaks.

### 2. Admin Authorization Middleware

Add middleware that only allows authenticated admin users through.

Acceptance criteria:

- Guests accessing `/admin` are redirected to `/login`.
- Authenticated non-admin users receive `403 Forbidden`.
- Authenticated admin users can access admin routes.
- Middleware is reusable for future admin pages.

### 3. Admin Route Group

Add an admin route group under `/admin`.

Acceptance criteria:

- Admin routes use `auth` and admin middleware.
- Route names are prefixed with `admin.`.
- `/admin` resolves to an admin dashboard.
- Login redirects back to intended admin URL after successful authentication.

### 4. Admin Dashboard Placeholder

Create a minimal admin dashboard page.

Acceptance criteria:

- Page is only visible to admin users.
- Page uses existing app layout.
- Page has a clear title such as "Admin".
- Optional useful summary metrics may include product count and order count.

### 5. Navigation

Expose an Admin link only to admin users.

Acceptance criteria:

- Guests do not see the Admin link.
- Regular authenticated users do not see the Admin link.
- Admin users see the Admin link.
- Existing Products, Orders, Cart, Profile, Login, Signup, and Logout links continue working.

### 6. Tests

Add feature tests for admin access.

Acceptance criteria:

- Guest visiting `/admin` redirects to `/login`.
- Non-admin authenticated user visiting `/admin` gets `403`.
- Admin authenticated user visiting `/admin` gets `200`.
- Admin login redirects back to `/admin` when `/admin` was the intended destination.

## Non-Goals

- Separate admin login page
- Separate admin guard
- Role/permission management UI
- Multiple staff roles
- Password reset changes
- Two-factor authentication
- Admin CRUD screens

## Implementation Notes

Use the existing Laravel `web` guard and session auth. Add only an `is_admin` flag for now; this is simpler and appropriate for a small internal admin surface.

A separate admin guard or table should only be introduced later if admins need separate credential rules, lifecycle management, or permissions distinct from normal users.
