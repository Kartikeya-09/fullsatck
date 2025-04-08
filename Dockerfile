# Use the official PHP image with Apache
FROM php:8.1-apache

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Enable Apache mod_rewrite for clean URLs
RUN a2enmod rewrite

# Update Apache configuration to allow .htaccess overrides
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Set the working directory
WORKDIR /var/www/html

# Copy project files to the container
COPY . /var/www/html

# Ensure .htaccess is included
RUN mv /var/www/html/public/.htaccess /var/www/html/.htaccess

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Set permissions for the web server
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
