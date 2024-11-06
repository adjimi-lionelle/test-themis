#!/bin/bash

# Installer les dépendances de Composer sans les packages de développement
composer install 

# Définir les permissions pour l'utilisateur web
chown -R www-data:www-data /var/www
chmod -R 755 /var/www

# Générer la clé d'application
php artisan key:generate

## Exécuter les migrations de base de données
php artisan migrate --force

# Exécuter les seeders de la base de données
php artisan db:seed --force

# Exécuter les tests
php artisan test --env=testing

php-fpm


