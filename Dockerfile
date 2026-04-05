FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    curl \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Install PHP deps FIRST
RUN composer install --no-dev --optimize-autoloader

# NOW clear Laravel caches (correct place)
RUN php artisan config:clear \
 && php artisan cache:clear \
 && php artisan route:clear \
 && php artisan view:clear

# Build frontend
RUN npm install && npm run build

# Fix storage
RUN mkdir -p storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    storage/logs \
 && chmod -R 775 storage bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache

# Permissions
RUN chown -R www-data:www-data /var/www/html

# Apache config
RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

EXPOSE 80