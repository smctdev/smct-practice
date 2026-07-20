# Project Instructions

## Branding and company name

- The current customer-facing company name is `SMCT Trading Company`.
- Use `config('app.name')` for customer-visible company-name text in Blade views. Do not hard-code the company name in individual pages.
- Before changing branding, search the repository for the current and proposed names. Review configuration, Blade views, email templates, metadata, documentation, and tests.
- `APP_NAME` is the source for Laravel's application name. Updating `.env.example` or a default in `config/app.php` does **not** update an existing local or production `.env` value; an actual environment value overrides both.

## Operational impact of APP_NAME

- `SESSION_COOKIE`, `CACHE_PREFIX`, and `REDIS_PREFIX` are pinned operational identifiers and must not change as a side effect of a branding update. Changing them can invalidate sessions or move cache namespaces. If a change is necessary, explain the user impact and obtain approval first.

## Deployment checklist

When a branding or environment-backed configuration change is approved for deployment:

1. Update the source-controlled defaults and every customer-visible usage.
2. Update the real deployment environment or `.env`; do not rely on `.env.example`.
3. On the target host, run `php artisan optimize:clear` followed by `php artisan config:cache`.
4. Verify the live page directly. Confirm the document title, header brand, page content, footer, and relevant response headers show the intended value.
5. Do not claim the change is complete based only on Git history or a local environment.

Never access or change production infrastructure without explicit user authorization.
