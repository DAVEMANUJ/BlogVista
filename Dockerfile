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

# Install production dependencies only
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Make start.sh executable
RUN chmod +x ./start.sh

# Start the application
CMD ["./start.sh"]
