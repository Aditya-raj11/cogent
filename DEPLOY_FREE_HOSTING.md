# Free Hosting Deployment Guide (Website + Admin)

This project is ready to run locally. To publish it on free hosting, use one of the options below.

## 1) Prerequisites

- PHP 8.1+
- MySQL database
- Composer dependencies installed
- Public storage linked (`php artisan storage:link`)

## 2) Local build checklist (already implemented)

1. Run migrations:
   - `C:\xampp\php\php.exe artisan migrate --force`
2. Clear caches:
   - `C:\xampp\php\php.exe artisan optimize:clear`
3. Verify endpoints:
   - `/api/app-configuration`
   - `/api/reels`
   - `/reels`
   - `/app/reels` (admin login required)

## 3) Free hosting option A: InfinityFree / 000webhost (shared hosting)

1. Create hosting account and MySQL database.
2. Upload Laravel project files (except `vendor` can be uploaded after `composer install` if shell is available).
3. Set document root to the `public` folder.
4. Configure `.env` with production DB and APP_URL.
5. Run once (if terminal available):
   - `php artisan migrate --force`
   - `php artisan storage:link`
   - `php artisan optimize:clear`
6. Ensure `storage` and `bootstrap/cache` are writable.

## 4) Free hosting option B: Render (recommended)

1. Push project to GitHub.
2. Create a free Render Web Service.
3. Build command:
   - `composer install --no-dev --optimize-autoloader && php artisan config:cache && php artisan route:cache`
4. Start command:
   - `php artisan serve --host 0.0.0.0 --port $PORT`
5. Add PostgreSQL/MySQL service and set env vars in Render dashboard.
6. Run migration job:
   - `php artisan migrate --force`

## 5) URLs to submit after deployment

- Website URL: `https://<your-domain>/`
- Admin URL: `https://<your-domain>/app/dashboard`
- Reels page URL: `https://<your-domain>/reels`
- Reels admin URL: `https://<your-domain>/app/reels`

## 6) APK location (already built)

- `C:\Users\KIIT0001\Desktop\cogent 2\extracted\streamit-ott v2.1.0\Mobile App\streamit-laravel-flutter-v2.1.0\streamit-laravel-flutter-v2.1.0\build\app\outputs\flutter-apk\app-release.apk`
