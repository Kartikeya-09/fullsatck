# Use the official PHP image
FROM php:8.1-apache

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Copy project files to the container
COPY . /var/www/html

# Set the working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install

# Expose port 80
EXPOSE 80
