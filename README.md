# ErrBeeNBee

ErrBeeNBee est un projet inspiré par Airbnb fait avec symfony

### Pré-requis

Pour installer le projet sur votre machine il vous faudra avoir PHP 7.1 minimum.
Pour cela il vous faudra installer WAMP sur Windows, MAMP sur macOS ou LAMP sur Linux. Pour ce faire, référez-vous à la procédure d'installation propre à chaque logiciel cité précédemment. 
Avoir "composer" d'installé en local ou en global

#### Pour installer composer sur Windows, il vous faudra :

Aller sur le site <a href="https://getcomposer.org/Composer-Setup.exe"> Get Composer</a>, télécharger le fichier et l'exécuter en suivant les instructions affichées.

#### Pour installer Composer sur macOS ou Linux, il vous faudra : 

##### Ouvrir un terminal sur macOS :
- Pressez simultanément sur les touches "Commande" + "Espace" de votre clavier
- Tapez ensuite "terminal" et validez avec la touche "Entrer"

##### Ouvrir un terminal sur Linux :
- Pressez simultanément sur les touches "Ctrl" + "Alt" + "T" de votre clavier

Une fois dans l'invite de commande ou le terminal déplacez-vous dans le dossier du projet grâce à la commande "cd".
Puis copiez et collez les lignes suivantes dans le terminal.

```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '93b54496392c062774670ac18b134c3b3a95e5a5e5c8f1a9f115f203b75bf9a129d5daa8ba6a13e2cc8a1da0806388a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv composer.phar /usr/local/bin/composer
```

### Installation

- Commencez par lancer WAMP, LAMP ou MAMP en fonction du système où vous êtes.

Ensuite créez un fichier .env.local à la racine du projet a partir du model du fichier .env
- Remplacez "user" par le nom d'utilisateur pour se conecter a la base de donnée
- Remplacez "password" par le nom d'utilisateur pour se conecter à la base de donnée
- Remplacez "dbname" par le nom de la base de donnée que vous voulez utiliser
Enrregistrez les modifications

Grâce à un terminal ou une invite de commande, déplacez-vous à la racine du projet, puis faites les commandes suivantes pour créer la base de données

```
composer install
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

Une fois la base de données créé et initialisé vous n'aurez qu'à lancer le serveur (mais pas trop fort ^_^) via la commande

```
php bin/console server:run
```

Le site est alors disponible à l'adresse indiqué dans le terminal ou l'invite de commande

## Étapes de création 

### Diagramme de classe : 

![alt text](https://raw.githubusercontent.com/parafeu/errbeenbee/dev/errbeenbee.png)

### Choix techniques

Nous avons décidés de créer une classe abstraite User et Accomodation, qui sont toutes étendues.
User est étendue par Traveller et Owner (Pour l'instant aucune différences entre les deux mais nous avons décidés de les faire en prévision)
Accomodation est étendue par Room et House, représentant une chambre ou un logement complet. Le voyageur peux donc réserver soit une chambre soit un logement complet.

### Travail effectué

- Création de l'index avec une visibilités sur les chambres et les logements
- Création du formulaire d'inscription pour les voyageurs et les propriétaires
- Implémentation du Bundle Sonata Media, permettant la mise en ligne et le stockage d'images
- Création de l'API Rest

### Travail à effectuer

- Gestion de l'authentification utilisateur
- Liaison entre les medias et les entités
- Réaliser l'API REST (uniquement disponible pour GET Rooms actuellement)

## Testes

Prochainement


## Créé avec 

* [Symfony](https://symfony.com/doc/current/index.html) - Le Framework utilisé
* [Composer](https://getcomposer.org) - Le gestionnaire de dépendance
* [MAMP](https://www.mamp.info/en/) - Utilisé pour la base de données et php
* [LAMP](https://doc.ubuntu-fr.org/lamp) - Utilisé pour la base de données et php


