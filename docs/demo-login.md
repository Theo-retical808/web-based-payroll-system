---
layout: default
title: Demo sign-in
---

# Demo sign-in

Open the splash page and choose **Sign in**.

On the `deploy/secure-auth` branch, enter the username and password provisioned for the administrator. To create the first account, set these server environment values before running `php artisan db:seed --class=AdminUserSeeder`:

| Environment key | Purpose |
| --- | --- |
| `ADMIN_USERNAME` | Initial administrator username |
| `ADMIN_EMAIL` | Initial administrator email |
| `ADMIN_PASSWORD` | Initial password (minimum 12 characters) |

The seeder stores a password hash and will not overwrite an existing account. Login uses Laravel's session guard, regenerates the session ID on success, and is throttled to five attempts per minute per username/IP. Signing out invalidates the session. Unauthenticated workspace routes redirect to sign-in.

The `demo/static-data` branch intentionally retains the public `admin` / `pass123` showcase login. It contains fictional sample records only and must never be used for real payroll data.
