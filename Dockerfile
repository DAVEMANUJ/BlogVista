FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libsqlite3-dev \
    sqlite3 \
    libzip-dev \
    && docker-php-ext-install pdo_mysql pdo_sqlite zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . /app

# Install dependencies without scripts
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Generate packages.php using a temp .env (needed for artisan to boot)
RUN echo 'APP_KEY=base64:dummykeyforbuildonlyxxxxxxxxxxxxxxxx=' > .env \
    && rm -f bootstrap/cache/packages.php bootstrap/cache/services.php \
    && php artisan package:discover --ansi \
    && rm .env

# Make start.sh executable
RUN chmod +x ./start.sh

# Start the application
CMD ["./start.sh"]
