# Installation

#### Pré-requis :

Dans le fichier `.env`, spécifier le chemin d'accès de la base de donnée SQLite. Créer un fichier `db.sqlite` vide si nécessaire.

```
DB_DATABASE="path/to/db.sqlite"
```

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

#### Lancement de l'application

Utiliser le serveur built-in :

`php artisan serve`