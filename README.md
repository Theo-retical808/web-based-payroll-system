# Web-Based Employee Records, Attendance, and Payroll System

A Laravel and Blade application for employee records, attendance tracking, and payroll review. The interface uses Tailwind CSS, Alpine.js, and Chart.js. The hosted edition stores user accounts in a database; payroll and attendance screens still use sample arrays and do not persist edits.

## Quick start

Requirements: PHP 8.2+, Composer, and Node.js with npm.

```bash
composer install
cp .env.example .env
php artisan key:generate
npm ci
npm run build
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
php artisan migrate
php artisan db:seed --class=AdminUserSeeder
php artisan serve
```

Before running the seeder, set `ADMIN_USERNAME`, `ADMIN_EMAIL`, and a unique `ADMIN_PASSWORD` of at least 12 characters in `.env`. On PowerShell, use `Copy-Item .env.example .env` for the environment-file step. Then open <http://127.0.0.1:8000>. No default production password is included. Run `npm run dev` instead of `npm run build` while developing the frontend.

## Demo sign-in

For the secure hosted edition, the administrator account is created from environment variables during deployment. For the database-free showcase branch, the demo credentials are `admin` / `pass123`.

The fixed account is only for the fictional-data showcase. Do not deploy it with real employee information.

## Included modules

- Dashboard with employee and attendance metrics, charts, recent activity, and payroll periods
- Employee directory, employee profiles, and compensation history
- Attendance overview, records, QR terminal simulation, and adjustment requests
- Payroll overview, periods, employee records, and printable payslip preview
- User management, business settings, and audit logs

## Sample data

The sample screens include 15 employees, varied attendance activity for the latest 30 days, payroll records for each sample employee, example user roles, audit entries, and attendance adjustments. Attendance dates are generated relative to the current date. In the secure hosted edition, only administrator accounts are currently database-backed; the operational payroll/attendance data and UI form changes are still illustrative and are not saved.

## Editions

- `deploy/secure-auth`: Laravel app with database-backed accounts, hashed passwords, login throttling, and an administrator provisioned from secrets.
- `demo/static-data`: no-database Laravel showcase with fictional PHP-array data and the fixed demo login. It still needs PHP hosting; it is not a static HTML export and cannot run on GitHub Pages.

## Documentation and GitHub Pages

Project documentation is in [`docs/`](docs/index.md). The [hosted deployment guide](docs/hosted-deployment.md) covers the PHP app branch. The [GitHub Pages guide](docs/github-pages.md) explains the documentation workflow. Pages publishes docs at <https://theo-retical808.github.io/web-based-payroll-system/>; it cannot run the Laravel/PHP application itself.

## Useful commands

```bash
php artisan route:list
php artisan test
npm run build
npm run dev
```

For architecture, data structures, and setup details, start at the [documentation home](docs/index.md).
