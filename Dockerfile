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

# Copy project files
COPY . /var/www/html/ticketflow-twig

# Set working directory
WORKDIR /var/www/html/ticketflow-twig

# Configure Apache document root
RUN sed -i 's#/var/www/html#/var/www/html/ticketflow-twig#g' /etc/apache2/sites-available/000-default.conf

# Fix permissions
RUN chown -R www-data:www-data /var/www/html/ticketflow-twig

EXPOSE 80

CMD ["apache2-foreground"]
