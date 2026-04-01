FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy existing application directory contents
COPY . /app

# Set production environment for build process
ENV APP_ENV=production
ENV APP_DEBUG=false

# Install dependencies
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Storage cache directories permissions
RUN chmod -R 777 storage bootstrap/cache || true

# Clear and prepare caches (we skip route:cache to avoid serialization issues)
RUN php artisan config:clear
RUN php artisan cache:clear
RUN php artisan view:clear
RUN php artisan storage:link || true

# We expose the PORT dynamically from Render. Render passes this env natively.
ENV PORT=10000
EXPOSE ${PORT}

# Run the server
CMD php -S 0.0.0.0:${PORT:-10000} -t public
