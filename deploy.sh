#!/bin/bash

# Laravel Deployment Script
# This script helps deploy your Laravel API to production

echo "🚀 Starting Laravel Deployment..."

# Check if .env.production exists
if [ ! -f .env.production ]; then
    echo "❌ .env.production file not found!"
    echo "Please create .env.production with your production settings"
    exit 1
fi

# Backup current .env
if [ -f .env ]; then
    cp .env .env.backup
    echo "✅ Backed up current .env to .env.backup"
fi

# Copy production environment
cp .env.production .env
echo "✅ Loaded production environment"

# Install dependencies
echo "📦 Installing dependencies..."
composer install --no-dev --optimize-autoloader

# Generate app key if not set
php artisan key:generate --force

# Run migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Clear and cache config
echo "🧹 Clearing and caching configuration..."
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Clear application cache
php artisan cache:clear

# Set proper permissions
echo "🔐 Setting file permissions..."
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

echo "✅ Deployment completed successfully!"
echo "🌐 Your Laravel API is ready at: $(php artisan route:list --json | grep -o '"uri":"[^"]*"' | head -1 | cut -d'"' -f4)"

# Restore backup if requested
read -p "Do you want to restore the backup .env? (y/N): " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    if [ -f .env.backup ]; then
        mv .env.backup .env
        echo "✅ Restored backup .env"
    fi
fi
