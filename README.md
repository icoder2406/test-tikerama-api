## Guide d'installation

Pour exécuter ce projet, vous devez suivre les étapes suivantes. Au cas où ceci, sautez cette étape..

### Prérequis
Avant de commencer, assurez-vous d'avoir les outils suivants installés sur votre machine :

- PHP (version 8.2)

- Composer (pour gérer les dépendances PHP)

- Git (pour cloner le dépôt)

Documentation locale de l'API [ici](/public/docs/API-Documentation.pdf)
### Installation

- Cloner ou télécharger [repository](https://github.com/icoder2406/test-tikerama-api).

- Aller dans le repertoire du projet et executer la commande **composer install** pour installer les dépendances.

- Ensuite copier le fichier **.env.example** en **.env**.

Configurer la base de donner de votre choix à travers les variables ci-dessous :

1. DB_CONNECTION=type-de-connexion
2. DB_HOST=127.0.0.1
3. DB_PORT=port
4. DB_DATABASE=nom-de-la-base
5. DB_USERNAME=nom-d-utilisateur
6. DB_PASSWORD=mot-de-passe

- Lancer la commande **php artisan key:generate** pour generer la clé de l'application.

- Exécuter les migrations en lançant la commande **php artisan migrate** (ajouter l'option **--seed** pour remplir les tables des données de tests).

A partir d'ici votre application est prête à être explorée. Pour ce faire il faut,

- Demarer le serveur local à travers la commande **php artisan serve**

- Ouverir un votre nagitaveur de choix et taper dans la barre de recherche [127.0.0.1:8000](http://127.0.0.1:8000) ou [localhost:8000](http://localhost:8000)

## Envoi des emails
Vu que cette application envoi des emails, vous aurez quelques configurations à prendre en compte dans le fichier **.env** pour que cela pusse fonctionner.

Reperer et modifier les valeurs des variables suivante dans votre fichier **.env**

- MAIL_MAILER=mailer
- MAIL_HOST=host
- MAIL_PORT=port
- MAIL_USERNAME=adresse-email
- MAIL_PASSWORD=mot-de-passe
- MAIL_ENCRYPTION=encrytion
- MAIL_FROM_ADDRESS=votre-adresse-email
