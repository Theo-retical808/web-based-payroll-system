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

The prototype uses file-based sessions and cache. It reads application examples from `resources/data/`, so local setup does not require a database or `php artisan migrate`.

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
