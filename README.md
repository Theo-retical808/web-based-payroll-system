# Web-Based Employee Records, Attendance, and Payroll System

A Laravel and Blade prototype for employee records, attendance tracking, and payroll management. The interface uses Tailwind CSS, Alpine.js, and Chart.js. Sample data is loaded from PHP files in `resources/data/`; the prototype does not require a database.

## Quick start

Requirements: PHP 8.2+, Composer, and Node.js with npm.

```bash
composer install
cp .env.example .env
php artisan key:generate
npm ci
npm run build
php artisan serve
```

Then open <http://127.0.0.1:8000>. On PowerShell, use `Copy-Item .env.example .env` for the environment-file step.

The app uses file-based sessions and cache by default, so a database setup or migration is not needed for this prototype. Run `npm run dev` instead of `npm run build` while developing the frontend.

## Demo sign-in

The demo credentials are:

| Username | Password |
| --- | --- |
| `admin` | `pass123` |

This fixed account is for local demonstrations only. Do not use it to protect a production deployment.

## Included modules

- Dashboard with employee and attendance metrics, charts, recent activity, and payroll periods
- Employee directory, employee profiles, and compensation history
- Attendance overview, records, QR terminal simulation, and adjustment requests
- Payroll overview, periods, employee records, and printable payslip preview
- User management, business settings, and audit logs

## Sample data

The mock data includes 15 employees, varied attendance activity for the latest 30 days, payroll records for each sample employee, user roles, audit entries, and attendance adjustments. Attendance dates are generated relative to the current date so the dashboard stays populated when opened later.

## Documentation and GitHub Pages

Project documentation is in [`docs/`](docs/index.md). The [GitHub Pages guide](docs/github-pages.md) explains the publishing workflow and its scope. The workflow publishes the documentation site at <https://theo-retical808.github.io/web-based-payroll-system/>; GitHub Pages cannot run the Laravel/PHP application itself.

## Useful commands

```bash
php artisan route:list
php artisan test
npm run build
npm run dev
```

For architecture, data structures, and setup details, start at the [documentation home](docs/index.md).

## Branch editions

- [`deploy/secure-auth`](https://github.com/Theo-retical808/web-based-payroll-system/tree/deploy/secure-auth): database-backed accounts and deployment instructions. Payroll and attendance still use sample data, so this is not ready for real payroll records.
- [`demo/static-data`](https://github.com/Theo-retical808/web-based-payroll-system/tree/demo/static-data): the original no-database Laravel showcase using fictional PHP-array data and public demo credentials. It requires PHP hosting; it is not a static HTML export.
