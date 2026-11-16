---
layout: default
title: Project overview
---

# Project overview

## Purpose

The application brings employee records, attendance tracking, and payroll review into one interface for a small business. It is a frontend-first prototype: forms and status actions demonstrate workflows in browser state and do not save changes to a database.

## Technology

- Laravel 12 and PHP 8.2+
- Blade views and reusable Blade components
- Tailwind CSS 4 for layout and design tokens
- Alpine.js 3 for interactive UI state
- Chart.js 4 for dashboard and attendance charts
- Vite for frontend asset compilation

## Request flow

1. `routes/web.php` maps splash, login, and protected workspace URLs.
2. Controllers load PHP arrays from `resources/data/` and prepare computed view data.
3. Blade views render the application layout, navigation, tables, forms, and charts.
4. Alpine.js handles search, filtering, tabs, demo modals, form feedback, and terminal simulation.

Demo login state is stored in the Laravel session. The workspace is protected by `EnsureDemoAuthenticated`; the sample employee, attendance, payroll, user, and audit data itself is not persisted.

## Main folders

| Path | Purpose |
| --- | --- |
| `app/Http/Controllers/` | View data preparation and demo login actions |
| `app/Http/Middleware/` | Protects workspace routes behind the demo session |
| `resources/data/` | Central sample data arrays |
| `resources/views/` | Blade pages, layouts, and shared components |
| `resources/css/`, `resources/js/` | Tailwind, Alpine, and Chart.js entry points |
| `routes/web.php` | Named splash, login, and module routes |
| `docs/` | This documentation and the GitHub Pages source |

## Data and security boundaries

This is not production payroll software. The fixed demo credentials are public, frontend actions are simulated, and sample employee information is fictional. Do not use the demo login or sample data for real accounts, employees, or payroll.
