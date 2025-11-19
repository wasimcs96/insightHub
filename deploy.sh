#!/bin/bash

# === CONFIG TELEGRAM ===
BOT_TOKEN="8147237383:AAFlLR_kUyT1se1cYRg8P3HGCOM_sCluoS0"
CHAT_ID="1868213202"   # ganti dengan chat_id kamu

# Load NVM (Node.js environment)
export NVM_DIR="$HOME/.nvm"
source "$NVM_DIR/nvm.sh"
nvm use --lts

# Navigate to project root
cd /www/wwwroot/EEI-DEV || exit 1

# Install PHP dependencies
echo "🔧 Running composer install..."
composer install --no-interaction --prefer-dist --optimize-autoloader
composer require livewire/livewire

# Install Node modules and build
echo "🧱 Running npm install and build..."
npm install
npx mix --production

php artisan livewire:publish
php artisan optimize:clear
# Start queue listener (in background)
# echo "🚀 Starting queue listener..."
# nohup php artisan queue:listen --tries=3 --timeout=60 > storage/logs/queue.log 2>&1 &