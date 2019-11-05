# YourTube

Description du projet

## Première séance, le 22 octobre 2019

- Validation du projet à l'oral par John et envoi via mail pour officialiser le projet.
- Un trello avec toutes les tâches nécessaires à la bonne réalisation de projet et l'attribution des tâches.
- Achat du nom de domaine et mise en place du serveur virtuel privé (VPS)
- Installation d'apache2 et du certificat SSL https://www.yourtube.fr
- Mise en place du repo Gitlab

## Deuxième séance, le 5 novembre 2019

### Ajout de l'authentification

```shell
composer require laravel/ui --dev

php artisan ui vue --auth

npm installl

npm run dev
```

## Ajout des seeders

On va générer un seeder avec la commande `make:seeder` de artisan
```shell
php artisan make:seeder UsersTableSeeder
```

Dans la fonction *run()* de notre `UserTableSeer.php` :
```php
public function run()
{
    factory(App\User::class, 50)->create();
}
```

Rajouter dans la fonction *run()* de notre `DatabaseSeeder.php` :
```php
$this->call([UsersTableSeeder::class]);
```

# Créer un profil

Création du modèle profil avec un controller, une factory et une migration :
```shell
php artisan make:model Profile -a
```

On procède à une relation `One-to-One` pour assigner un profil à un user :

```php
// App\User
public function profile() {
    return $this->hasOne('App\Profile');
}

// App\Profile
public function user() {
     return $this->belongsTo('App\User');
}
```

