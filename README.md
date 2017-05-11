# TPI-media

Ce dépot contient toutes les sources utilisées pour la création de mon TPI de fin d'apprentissage.

## Infos générales

Ce projet est réalisé dans le cadre de ma formation de médiamaticien.
J'utilise Laravel et Vue.js pour la concéption de mon site.

Le site est en ligne [ici](https://tpimedia.bastiennicoud.ch)

## Installation

Si vous clonez le dépot en local, pour que l'application soit fonctionelle il faut:

Installer les dépendances avec composer:
```bash
composer update
```
Et dans le dossier front les dependances npm:
```bash
npm install
```

Une fois toutes les dependances installées, il faut créer un fichier .env a la racine sur l'exemple .env.example  
Dans lequel on remplis les infos liées a l'environement de dev

Pour finir, le virtual host doit pointer dans le doosier public, pour que l'application soir fonctionelle
