
# Task Manager - Laravel Project

## Description

Ce projet est une application Laravel pour gérer des tâches, où les utilisateurs peuvent créer, visualiser, mettre à jour et supprimer leurs tâches. Il inclut également des tests unitaires et de fonctionnalité pour valider les actions principales.

## Prérequis

Avant de commencer, assurez-vous d'avoir installé les éléments suivants :

- **PHP** (>=8.0)
- **Composer** (pour gérer les dépendances PHP)
- **MySQL** ou **PostgreSQL** (ou tout autre base de données compatible Laravel)
- **Node.js** et **npm** (pour gérer les dépendances front-end si nécessaire)

## Installation

Suivez les étapes ci-dessous pour configurer et exécuter le projet localement.

### 1. Cloner le projet

Clonez ce dépôt sur votre machine locale :

```bash
git clone https://github.com/votre-utilisateur/task-manager.git
cd task-manager
```

### 2. Installer les dépendances PHP

Utilisez **Composer** pour installer les dépendances PHP du projet :

```bash
composer install
```

### 3. Configurer l'environnement

Dupliquez le fichier `.env.example` en `.env` :

```bash
cp .env.example .env
```

Modifiez le fichier `.env` pour configurer les détails de la base de données. Par exemple, pour une base de données MySQL :

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

### 4. Générer la clé de l'application

Générez la clé unique pour l'application Laravel :

```bash
php artisan key:generate
```

### 5. Exécuter les migrations

Créez la base de données mentionnée dans le fichier `.env`, puis exécutez les migrations pour générer les tables :

```bash
php artisan migrate
```

### 6. (Facultatif) Exécuter les Seeders

Si vous souhaitez peupler la base de données avec des données factices, exécutez les seeders :

```bash
php artisan db:seed
```

### 7. Démarrer le serveur de développement

Vous pouvez maintenant lancer le serveur de développement Laravel avec la commande suivante :

```bash
php artisan serve
```

L'application sera accessible à l'adresse suivante : `http://localhost:8000`

## Tests

Ce projet utilise PHPUnit pour les tests unitaires et de fonctionnalités. Suivez les étapes ci-dessous pour exécuter les tests.

### 1. Configurer la base de données de test

Dans le fichier `.env`, configurez les paramètres de votre base de données de test (généralement, vous dupliquez les paramètres de la base de données principale et modifiez le nom de la base de données) :

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager_test
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

### 2. Exécuter les migrations pour la base de données de test

Exécutez les migrations spécifiquement pour la base de données de test :

```bash
php artisan migrate --env=testing
```

### 3. Exécuter les tests

Utilisez la commande suivante pour exécuter tous les tests :

```bash
php artisan test
```

Cela exécutera les tests unitaires et de fonctionnalité. Vous devriez voir un résumé des résultats dans la console.

## Déploiement

Voici les étapes à suivre pour déployer ce projet sur un serveur de production :

1. Installez les dépendances en exécutant `composer install --no-dev`.
2. Exécutez les migrations avec `php artisan migrate --force`.
3. Assurez-vous que le fichier `.env` est correctement configuré pour la production.
4. Configurez un serveur web (comme Nginx ou Apache) pour servir l'application Laravel.
5. Utilisez `php artisan config:cache` pour mettre en cache la configuration.
6. Redémarrez les services de votre serveur si nécessaire.

## Contribution

Si vous souhaitez contribuer à ce projet, veuillez suivre ces étapes :

1. Clonez le dépôt.
2. Créez une branche pour vos modifications (`git checkout -b feature/nouvelle-fonctionnalite`).
3. Poussez vos modifications (`git push origin feature/nouvelle-fonctionnalite`).
4. Ouvrez une pull request.

## Licence

Ce projet est sous licence [MIT](LICENSE).
