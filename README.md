
# Mon projet de dev symfony

## Description

Dans le but de ma formation en autodidacte, j'ai développé une application permettant de centraliser l'accès aux statistiques Steam des joueurs.

##	Prérequis

1. PHP version 8.1.0
2. Postgres 14
3. Symfony version 6.0 minimum
4. Composer
5. Npm

##	Mise en place du projet

### Installation du projet et des dépendances.

Après avoir cloné le projet

Exécutez la commande ``cd SteamLinks`` pour vous rendre dans le dossier depuis le terminal.

Ensuite, dans l'ordre taper les commandes dans votre terminal :

- 1 ``composer install`` afin d'installer toutes les dépendances composer du projet.

- 2 ``npm install``      afin d'installer toutes les dépendances npm du projet.
  
- 3 ``npm run dev ``    afin d'initialiser les modules.

### Installer la base de donnée Postgres.

Pour paramétrer la création de votre base de donnée, rdv dans le fichier .env du projet, et modifier la variable d'environnement selon vos paramètres :

``DATABASE_URL="postgresql://user:password@host:port/Steamlinks"``

Puis exécuter la création de la base de donnée avec la commande : ``symfony console doctrine:database:create``


- 4 Exécuter la migration en base de donnée :                                        ``symfony console doctrine:migration:migrate``

- 5 Ajouter la clé API Steam dans le fichier .env

- 5 Vous pouvez maintenant accéder à votre portfolio en vous connectant au serveur : ``symfony server:start``



## Amélioration à venir




