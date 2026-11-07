FROM php:8.3-cli

# System deps + PHP extensions Laravel needs
RUN apt-get update && apt-get install -y \
    git curl unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl gd \
    && rm -rf /var/lib/apt/lists/*

# Node (for Vite build)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction \
    && npm install \
    && npm run build

COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["/entrypoint.sh"]
