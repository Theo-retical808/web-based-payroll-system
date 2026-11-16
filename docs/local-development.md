---
layout: default
title: Local development
---

# Local setup and development

## Requirements

- PHP 8.2 or later with Laravel's required PHP extensions
- Composer 2
- Node.js and npm

## Install

From the project root:

```bash
composer install
cp .env.example .env
php artisan key:generate
npm ci
npm run build
php artisan serve
```

On PowerShell, replace the copy command with `Copy-Item .env.example .env`. Then visit <http://127.0.0.1:8000>.

The `deploy/secure-auth` edition requires a database for user accounts. For SQLite, create `database/database.sqlite` before running `php artisan migrate` (the README includes a cross-platform PHP command for this). Set `ADMIN_USERNAME`, `ADMIN_EMAIL`, and a unique `ADMIN_PASSWORD` of at least 12 characters in `.env`, then create the first administrator with `php artisan db:seed --class=AdminUserSeeder`.

The payroll, attendance, and audit examples still come from PHP arrays in `resources/data/`; their changes are not persisted yet. The `demo/static-data` branch omits the account database and uses the public demo login.

## Frontend development

Run Vite's development server while changing CSS or JavaScript:

```bash
npm run dev
```

Create production assets with:

```bash
npm run build
```

## Useful Laravel commands

```bash
php artisan route:list
php artisan test
php artisan view:clear
```

## Configuration notes

- Set `APP_NAME` and `APP_URL` in your local `.env` if desired.
- Keep `.env` and any real environment credentials out of Git.
- `SESSION_DRIVER=file`, `CACHE_STORE=file`, and `QUEUE_CONNECTION=sync` are suitable defaults for this prototype.
- The application timezone is `Asia/Manila`.
