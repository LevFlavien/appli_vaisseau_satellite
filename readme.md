# Installation

#### Pré-requis :

Installation des composants nécessaires :

`composer install`

Installation de la base de données :

```
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

Utiliser le serveur built-in :

`php artisan serve`