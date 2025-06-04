FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    libicu-dev \
    libzip-dev \
    supervisor

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd intl zip

# Install Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Copy Xdebug configuration
COPY .docker/php/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory
COPY . /var/www

# Install project dependencies
RUN composer install

# Copy supervisor configuration
COPY .docker/supervisor/queue.conf /etc/supervisor/conf.d/

# Change ownership of our applications
RUN chown -R www-data:www-data /var/www

# Create the log directory for supervisor
RUN mkdir -p /var/log/supervisor

# Create a startup script
COPY .docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

CMD ["/usr/local/bin/start.sh"] 