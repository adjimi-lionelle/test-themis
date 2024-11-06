# backend/Dockerfile

# Utiliser une image PHP avec les extensions nécessaires pour Laravel
FROM php:8.1-fpm

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www

# Copier le code Laravel
COPY . /var/www/

COPY script.sh /var/www/script.sh

RUN chmod +x /var/www/script.sh

EXPOSE 8000

CMD ["/var/www/docker/script.sh"]
