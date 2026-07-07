# Gunakan image PHP 8.2 dengan Apache
FROM php:8.2-apache

# Install dependensi sistem yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libpq-dev

# Install ekstensi PHP (termasuk pdo_pgsql jika Anda pakai Postgres Render)
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd pdo_pgsql

# Aktifkan mod_rewrite Apache untuk routing Laravel
RUN a2enmod rewrite

# Arahkan Apache ke folder public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set folder kerja di dalam container
WORKDIR /var/www/html

# Copy semua file project Anda ke dalam server/container
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Jalankan instalasi vendor Laravel
RUN composer install --no-dev --optimize-autoloader

# Install Node.js dan NPM untuk membuild Vite (CSS/JS)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install NPM packages dan jalankan build
RUN npm install
RUN npm run build

# Berikan izin akses untuk folder cache, storage, dan build
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/build

# Render membutuhkan expose port
EXPOSE 80
