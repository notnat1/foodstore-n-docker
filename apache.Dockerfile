# Stage 1: build front-end dengan Node
FROM node:20-alpine AS node-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: PHP-Apache + Laravel + hasil build
FROM php:8.2-apache

# Instal ekstensi PHP
RUN apt-get update --allow-releaseinfo-change \
    && apt-get install -y libpng-dev libonig-dev libxml2-dev zip unzip libzip-dev libicu-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set DocumentRoot ke public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN a2enmod rewrite \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && printf '\n<Directory "%s">\n  Options Indexes FollowSymLinks\n  AllowOverride All\n  Require all granted\n</Directory>\n' "$APACHE_DOCUMENT_ROOT" \
    >> /etc/apache2/apache2.conf

# Salin hasil build front-end ke public/dist (sesuaikan path output Vite/Mix kamu)
# COPY --from=node-builder /app/dist /var/www/html/public/dist
COPY --from=node-builder /app/public/build /var/www/html/public/build

# Salin kode Laravel
WORKDIR /var/www/html
COPY --chown=www-data:www-data . .

# Composer install & setup .env
RUN composer install --no-interaction --no-dev --optimize-autoloader --ignore-platform-reqs \
    && cp .env.prod .env \
    && php artisan key:generate --force

# Atur permission
RUN chown -R www-data:www-data storage bootstrap/cache public

EXPOSE 80
CMD ["apache2-foreground"]


# FROM php:8.2-apache

# # 1. Install OS deps + PHP extensions
# RUN apt-get update --allow-releaseinfo-change && \
#     apt-get install -y git curl libpng-dev libonig-dev libxml2-dev zip unzip libzip-dev libicu-dev && \
#     docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl && \
#     apt-get clean && rm -rf /var/lib/apt/lists/*

# # 2. Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# RUN composer config --global github-protocols https \
#     && composer config --global process-timeout 2000

# # 3. Salin kode sekaligus set ownership
# WORKDIR /var/www/html
# COPY --chown=www-data:www-data . /var/www/html

# # 4. Atur DocumentRoot ke public
# ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
# RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
#     -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
#     /etc/apache2/sites-available/*.conf \
#     /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# # 5. Enable rewrite & buka akses directory public
# RUN a2enmod rewrite \
#     && printf '\n<Directory "%s">\n\
#     Options Indexes FollowSymLinks\n\
#     AllowOverride All\n\
#     Require all granted\n\
#     </Directory>\n' "$APACHE_DOCUMENT_ROOT" \
#     >> /etc/apache2/apache2.conf

# # 6. Install PHP deps, env & key
# RUN composer install --no-interaction --no-dev --optimize-autoloader --ignore-platform-reqs \
#     && cp .env.prod .env \
#     && php artisan key:generate --force

# # 7. Final permission fix
# RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

# EXPOSE 80
# CMD ["apache2-foreground"]
