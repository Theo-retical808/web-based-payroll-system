---
layout: default
title: No-database showcase
---

# No-database showcase edition

The `demo/static-data` branch is the classroom/showcase edition. It reads fictional employee, attendance, and payroll records from PHP arrays in `resources/data/`. It has no application database requirement; demo sign-in uses `admin` / `pass123`, Laravel sessions use local files, and UI form actions only update the current browser view.

## Run locally

Install PHP 8.2+, Composer, Node.js, and npm. From the repository root:

```bash
composer install
cp .env.example .env
php artisan key:generate
npm ci
npm run build
php artisan serve
```

On PowerShell, use `Copy-Item .env.example .env`. Open <http://127.0.0.1:8000>.

## Hosting

Despite the phrase “static data”, this edition still renders Laravel and Blade pages on the server. It needs a PHP-capable host with the document root set to `public/`. It is not a generated static HTML site and cannot run on GitHub Pages. GitHub Pages in this repository publishes the documentation only.

Use fictional records only. The login credentials are public by design, and attendance/payroll edits do not persist.
