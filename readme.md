# Installation

#### Pré-requis :

* Environnement Linux
* PHP 7

#### Fichier .env

Généreration du fichier `.env` et de la clé d'application :

```
mv .env.example .env
php artisan key:generate
```

#### Composer

Installation des composants PHP nécessaires :

```
composer install
```

#### Base de données :

Création du fichier sqlite et migration :

```
touch database/database.sqlite
php artisan migrate
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

#### Lancement du script de sauvegarde

Déplacer le projet sur le bureau
Modifier le fichier sauvegarde.bat :
Changer le nom d'user par celui de votre pc.
Si besoin, changez le lieu de destination de la copie.
