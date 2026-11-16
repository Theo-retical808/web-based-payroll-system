---
layout: default
title: GitHub Pages
---

# GitHub Pages and deployment

## What Pages publishes

The workflow in `.github/workflows/pages.yml` builds and publishes this `docs/` directory as a Jekyll documentation site. It runs on pushes to `main` that change documentation or the workflow file, and can also be started manually from GitHub Actions.

Expected site URL: <https://theo-retical808.github.io/web-based-payroll-system/>.

The workflow uses GitHub's Pages build and deploy actions. `configure-pages` is set to enable Pages for the repository when needed. If repository policy prevents automatic enablement, open **Settings → Pages** and select **GitHub Actions** as the source.

## Laravel hosting

GitHub Pages serves static files and cannot run PHP, Laravel routes, sessions, or the interactive payroll application. It therefore hosts this documentation site only. To make the application available on the internet, deploy the Laravel project to a PHP-capable web host and configure a secure production environment separately.

## Workflow outline

1. Check out the repository.
2. Configure the repository's Pages site.
3. Build `docs/` with Jekyll.
4. Upload the static site artifact and deploy it to the `github-pages` environment.

For the official Pages workflow requirements, see [GitHub's custom workflow guide](https://docs.github.com/en/pages/getting-started-with-github-pages/using-custom-workflows-with-github-pages).
