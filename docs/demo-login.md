---
layout: default
title: Demo sign-in
---

# Demo sign-in

Open the splash page and choose **Sign in**. The local demo account is:

| Field | Value |
| --- | --- |
| Username | `admin` |
| Password | `pass123` |

Successful login starts a Laravel session and redirects to the dashboard. The user menu's **Sign Out** action clears that session. Unauthenticated workspace routes redirect to the login page.

These credentials are intentionally fixed for a local classroom/demo prototype. They are visible in source and documentation and must not be treated as secure production credentials.
