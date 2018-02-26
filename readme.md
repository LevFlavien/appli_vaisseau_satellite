# Installation

#### Pré-requis :

Installation des composants nécessaires :

```
composer install
```

Installation de la base de données :

```
touch database/database.sqlite
php artisan migrate
```

#### Fichier .env

Générer le fichier `.env` et la clé d'application :

```
mv .env.example .env
php artisan key:generate
```

#### (Optionnel) Développement front-end :

Installation des packages :

`npm install`

Compilation des assets :

`npm run dev`

#### (Optionnel) Base de données custom

Les paramètres suivant peuvent être modifiés :

```
DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE="path/to/db.sqlite"
```

#### Lancement de l'application

##### Scheduler

Lancer le cron job :

`php artisan schedule:run`

##### Interface

Utiliser le serveur built-in :

`php artisan serve`
