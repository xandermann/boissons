FROM php:apache AS php_dev

RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN a2enmod rewrite
RUN a2enmod headers

# Install Postgre PDO
# RUN apt-get update \\
# && apt-get install -y libpq-dev \\
# && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \\ # Install postgres extensions
# && docker-php-ext-install pdo pdo_pgsql pgsql

COPY --from=composer /usr/bin/composer /usr/bin/composer

# Point to /var/www/html/public/ folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public/
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf


FROM php AS php_prod
# Your prod config here
