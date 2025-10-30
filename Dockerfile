# Use the official PHP image with Apache
FROM php:8.2-apache

# Enable necessary Apache modules
RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite

# Copy project files into the container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 for Render
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
