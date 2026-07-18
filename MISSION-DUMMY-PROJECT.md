# MISSION — the S1 practice project: a dummy Laravel app that mirrors SMCT's stack

Build a REAL, runnable Laravel application in THIS repo (repo root = Laravel project
root). It is the working vehicle for Session 1 on Monday (Jul 20): the SMCT devs will
open it in Codex and prompt against it. It must feel like production code someone
actually wrote — not like a tutorial.

## Stack + constraints
- Laravel (latest stable via `composer create-project laravel/laravel .`), PHP 8.5 is installed.
- SQLite for the DB (their real stack is MySQL — mirror the *code patterns*, not the engine; note this in the README).
- Neutral small-commerce domain (orders / customers / products). No real SMCT data, names, or code.
- Plain-PH-English microcopy where user-facing.
- **Do NOT create an AGENTS.md** — Session 1 creates it live (that's the S10 exercise).

## The four planted exercise sites (from the deck's Example Bank — these are the session)
1. **The N+1 (S5 demo):** `OrderController@index` renders an orders list where the Blade
   loops `$order->customer->name` and `$order->items->count()` per row WITHOUT eager
   loading. Seeder creates ~3000 orders with customers + items so the slowdown is real.
2. **The onboarding maze (S7):** `CheckoutController` with a `calculateTotal()` where tax
   is applied BEFORE any discount hook point — readable but non-obvious, so "where would
   a loyalty discount go without breaking tax?" is a real question.
3. **The null-phone crash (S9):** `ProfileUpdateRequest` whose `phone` rule is missing
   `nullable`, so updating a profile with no phone actually fails. Include a test that
   EXPOSES the bug as a skipped/todo test with a comment — do not fix it.
4. **The off-system form (S7 alt):** a Blade signup form styled inconsistently with the
   app's `.card` component + tokens, plus robotic validation messages ("Invalid input.")
   — raw material for the design/microcopy exercises.

## Quality bar (done_when will check these)
- `composer validate` passes; `php artisan migrate --seed` exits 0 on a fresh sqlite db;
  `php artisan test` passes (a few real feature tests incl. orders index renders).
- The four sites exist at the named classes/paths above, each carrying a short
  `// planted for S1: <exercise>` comment so Ely can find them (the devs won't grep comments).
- `README.md`: 5-minute setup for a dev (clone → composer install → migrate --seed →
  artisan serve), what this repo is for, and the MySQL/SQLite note.
- Realistic git history is NOT required — one clean commit of the finished app is fine.
- Never commit `vendor/` (default .gitignore handles it) or any secrets.
