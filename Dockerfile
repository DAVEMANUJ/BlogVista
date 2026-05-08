FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libsqlite3-dev \
    sqlite3

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql pdo_sqlite

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . /app

# Make build.sh executable
RUN chmod +x ./build.sh

# Run the build script
RUN ./build.sh

# Start the PHP built-in server
CMD php -S 0.0.0.0:${PORT:-8000} -t public
