# Laravel Minimal

This repository is a stripped-down Laravel full-stack app for the simplest Blade + controller + database flow.

## What stayed

- Blade rendering for the frontend
- Laravel routing, controllers, validation, and Eloquent on the backend
- A single `people` table for persistence
- MySQL and SQLite support, with MySQL as the default example
- PHPUnit feature tests for the homepage flow

## What was removed

- The default Laravel welcome page
- Vite, Tailwind, and the Node build pipeline from the app flow
- Database-backed cache, queue, and session scaffolding
- Extra starter migrations that were not needed for this app shape

## Local setup

```bash
composer run setup
composer run dev
```

`composer run setup` copies `.env.example` when needed, generates the app key, and runs migrations. If you switch `DB_CONNECTION` to `sqlite`, it also creates `database/database.sqlite` automatically.

## Proxy configuration

The app reads `TRUSTED_PROXIES` from the environment in `bootstrap/app.php`.

- In `local`, leaving `TRUSTED_PROXIES` empty means Laravel will not trust any proxy headers.
- Outside `local`, leaving it empty falls back to `*`, so all proxies are trusted.
- If you deploy behind a load balancer or reverse proxy, set `TRUSTED_PROXIES` explicitly to the proxy IP, CIDR range, or a comma-separated list.

Example:

```env
TRUSTED_PROXIES=10.0.0.0/8,192.168.1.10
```

## Default Login

Running the seeder creates a development account:

- Email: `admin@example.com`
- Password: `password`

```bash
php artisan db:seed
```

## Tests

```bash
php artisan test
```
