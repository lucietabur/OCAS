# OCAS - Outils Complémentaires A Stage


## Installation

### Requis:

- PHP >= 7.1
- Composer >= 1.1

Si ils ne sont pas installés, installer des fichiers .xml de PHP 7.1 avec cette commande:
```bash
$ sudo apt-get install php7.1-xml
```

#### Installer les composants de l'application
```bash
$ composer install
```

### Base de données

_TODO: Partie base de données à renseigner quand celle-ci sera existante_

Créer le schéma
```bash
$ php bin/console doctrine:database:create
```

Mettre à jour le schéma
```bash
$ php bin/console doctrine:migrations:migrate
```

#### Lancer le serveur
```bash
$ php bin/console server:run
```
##Documentation

### Conception
[modèle de conception de données](uml_nouveau.png)
### Utilisation 
[manuel d'utilisation](manuel/manuel.pdf)
### Maintien de l'application

#### Pour modifier les modèles pdf
Les fichiers word se situent à la racine fichiers générés.
Ils sont générés dans le service situé dans src/OCAS/OCASBundle/Services/GenerateDoc.php.

#### Pour modifier la structure de la base de données
Les fichiers se situent dans src/OCAS/OCASBundle/Entity

Pour appliquer les changements
```
bin/console doctrine:schema:update --force
```

=======

A Symfony project created on December 22, 2017, 10:02 am.
