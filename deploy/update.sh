#!/usr/bin/env bash
# Script update cepat setelah menarik perubahan kode baru.
# Jalankan dari root proyek: bash deploy/update.sh
set -euo pipefail

echo "==> Menarik kode terbaru (jika pakai git)"
git pull --ff-only || echo "(lewati git pull)"

echo "==> Composer install (produksi)"
composer install --no-dev --optimize-autoloader

echo "==> Build aset frontend"
npm ci
npm run build

echo "==> Migrasi database"
php artisan migrate --force

echo "==> Bersihkan & cache ulang konfigurasi"
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Pastikan symlink storage ada"
php artisan storage:link || true

echo "==> Selesai. Restart PHP-FPM jika perlu:"
echo "    sudo systemctl reload php8.3-fpm"
