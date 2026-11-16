---
layout: default
title: Hosted deployment
---

# Hosted Laravel deployment

Use the `deploy/secure-auth` branch for a PHP host that supports Laravel 12 and PHP 8.2 or later. Point the web server's document root at the repository's `public/` directory. Configure a managed MySQL, MariaDB, PostgreSQL, or persistent SQLite database and pass its connection values through the host's environment settings.

## Build and deploy

Build frontend assets and install production dependencies as part of the host's build step:

```bash
composer install --no-dev --optimize-autoloader
npm ci
npm run build
```

Set the following deployment environment values in the host dashboard. Do not commit real values to Git:

| Variable | Production value |
| --- | --- |
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_URL` | The HTTPS URL of the app |
| `APP_KEY` | Generate once with `php artisan key:generate --show`; keep it stable |
| `DB_CONNECTION` and `DB_*` or `DB_URL` | Values for the provisioned database |
| `SESSION_DRIVER` | `database` |
| `SESSION_SECURE_COOKIE` | `true` |
| `ADMIN_USERNAME` | A unique administrator username |
| `ADMIN_EMAIL` | Administrator email address |
| `ADMIN_PASSWORD` | A unique password with at least 12 characters |

Run database setup during deployment:

```bash
php artisan migrate --force
php artisan db:seed --class=AdminUserSeeder
php artisan optimize
```

The seeder creates the first administrator and does not overwrite an existing username. Run it only after the administrator environment variables are configured. Store those values as host secrets, not in source control.

## Current application scope

This branch replaces the hard-coded login with Laravel's database-backed session authentication, hashed passwords, and login rate limiting. The employee, attendance, payroll, audit, and settings screens still load fictional sample data from `resources/data/`; current form actions do not save business records. Treat this as a hosted showcase until those modules are migrated to validated database-backed workflows. Do not enter real employee or payroll information yet.

For a no-database showcase, use the [`demo/static-data` branch](https://github.com/Theo-retical808/web-based-payroll-system/tree/demo/static-data). That branch still requires Laravel/PHP hosting; GitHub Pages cannot run the app.
