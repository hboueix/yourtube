# YourTube

Avant de commencer, assurez-vous d'avoir Docker et d'avoir copié `docker-compose.override.yml.dist` en `docker-compose.override.yml` afin de 
pouvoir redéfinir les services que vous souhaitez utiliser et les ports attribués.

## Nouvelle procédure de mise en place du projet

- Cloner le projet
- À la racine du projet, entrez la commande `export UID=${UID}`
- Puis `docker-compose up --build -d`

## Procédure de mise en place du projet

- Cloner le projet
- Configurer le .env en accord avec votre configuration
- Créer une base de donnée nommée : yourtube
- Effectuer la commande : `composer install` puis `npm install`
- Enfin `npm run dev`
- Réaliser la commande : `php artisan migrate:refresh --seed`
- Générer sa clé : `php artisan key:generate`
- Créer le lien symbolique : `php artisan storage:link`
- Lancer le serveur avec la commande : `php artisan serve`
- Yourtube est accessible sur l'adresse 127.0.0.1:8000 !

### Informations utiles

Un compte par défaut est créé. Vous pouvez donc vous connecter sans avoir à vous inscrire. 

Le compte créé est :

- mail : admin@yourtube.fr
- mdp : M0td3p4ss3

## Fonctionnalités

### Authentification

- Connexion au compte
- Inscription du compte
- Réinitialisation du mot de passe
- Suppression du compte

### Vidéo

- Upload d'une vidéo
- Modification d'une vidéo
- Suppression d'une vidéo
- Partage d'une vidéo
- Like / Dislike d'une vidéo (ajax)
- Signalement d'une vidéo
- Commenter une vidéo (ajax)

### Administration

- Modération des vidéos
- Modération des utilisateurs (rôles / suppression)
- Modération des signalements
- Modération des commentaires
- Création / suppression des catégories
- Notifications sur l'ensemble du site
- Suivi graphiques de nombreuses statistiques

### Utilisation

- Visionnage d'une vidéo
- Recherche d'une vidéo
- Recherche d'un profil
- Visionnage public d'un profil
- Suivi du profil sur dashboard
- Abonnement à un profil
- Notifications (mail, web notif api, toasters, etc.)

### Premium

- Espace de stockage contrôlé et limité
- Paiement pour compte premium et espace illimité
- Personnalisations supplémentaire

