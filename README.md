# YourTube

## Mise en place

Tout d'abord, il faut bien sûr cloner le projet sur votre machine. Rendez-vous maintenant à la racine du projet fraîchement cloné et tapez la commande `docker-compose up -d`. Cette commande va créer 3 containers : 
- *yt-webserver* : le container principal qui fait tourner un serveur web apache et notre application Laravel
- *yt-mariadb* : comme son nom l'indique c'est notre base de données MariaDB
- *yt-myadmin* : container optionnel pour avoir un PHPMyAdmin  

Voilà votre application est prête, vous pouvez vous rendre sur `localhost:80` pour l'utiliser.
  
### Informations utiles

Si le container *yt-myadmin* ne vous intéresse pas, vous pouvez le supprimer dans le fichier `docker-compose.yml`. Les containers *yt-webserver* et *yt-mariadb* sont en revanche indispensables.  

Un compte par défaut est créé. Vous pouvez donc vous connecter sans avoir à vous inscrire. 

Le compte créé est :

- mail : admin@yourtube.fr
- mdp : M0td3p4ss3

Pour un déploiment en production, vous pouvez modifier :
- le fichier de configuration du vhost dans le fichier `config/vhosts/yourtube.conf` 
- le fichier de configuration php `config/php/php.ini`
- le fichier d'environnement dans `www/.env`

### Troubleshooting

Il est possible que vous rencontriez des problèmes lors du lancement des containers si vous avez déjà des applications qui utilisent les ports définis dans le fichier `docker-compose.yml`. Vous pouvez alors les modifier. Pour rappel voici les ports définis par défaut :
- 80
- 443
- 3306
- 8080

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

