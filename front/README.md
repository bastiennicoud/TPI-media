# FRONT

Ce doosier contient toutes les sources ainsi que le systeme de build utilisés pour générer l'application Vue.js.

## Vue.js

Pour toute la partie front end de mon application, j'ai choisis d'utiliser le framework [Vue.js](https://vuejs.org).  
C'est un framework qui a pour but de simplifier la manière de gerer la vue coté client, en simplifiant grandement l'interaction
avec le DOM, et en pérmétant d'organiser son application en composants séparés et réutilisables.
Vue.js est un peu du même genre que Angular JS 2 ou React, mais en offrant un approche plus simple et légére.
Par exemple, Angular et React viennet avec tout un echosytème et plusieurs composants pré consus, là ou vue nous fournis uniquement le "moteur"
a nous de construire par dessus.

## Webpack

Pour utiliser vue de manière simple, il est possible de l'utiliser avec webpack, cela va notament nous permetre d'utiliser des fichiers
a l'extension .vue qui représenteront nos composants, et de charger des librairies simplement.  
Le principe est simple, je vais développer mon app graçe aux concepts introduits par vue. Et en paralele je vais demarer un serveur
de développement qui utilise node.js avec webpack. Ce serveur va analyser mon code et automatiquement construire les fichiers
interprétables par la navigateur.

## Organisation du doosier

### Doosiers
* **build** Contient des scripts liés a l'utilisation de Webpack
* **config** Contient ma configuration de Webpack personalisée pour ce projet
* **.nodes_modules** Contient tous les packages liés a node.js
* **src** C'est ici que ce trouve tous les fichiers sources de mon application front-end, traités par Webpack
* **static** C'est ici que se trouve les ressources que Webpack ne va pas traiter
### Fichiers
* **.babelrc** Configuration du module babel (permet de convertir du JS ES6 en ES5)
* **.editconfig** Configuration de base
* **.postcssrc** Config de postcss (un outil pour transformer le css avec javascript, utilisé ici par Webpack)
* **.index.html** Point d'entrée de l'application, le premier que Webpack traite
* **packages.json** Decrit toutes les dépendances du projet
* **prepros-6.config** Configuration de prepros 6 (pour compiler du scss en css)