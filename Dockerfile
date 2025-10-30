# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy all project files into container
COPY . /var/www/html/

# Set working directory to project folder
WORKDIR /var/www/html/ticketflow-twig

# Tell Apache to use this directory as web root
RUN sed -i 's#/var/www/html#/var/www/html/ticketflow-twig#g' /etc/apache2/sites-available/000-default.conf

# Give Apache permissions
RUN chown -R www-data:www-data /var/www/html

# Expose Apache port
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
