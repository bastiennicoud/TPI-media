<!-- Composant App -->
<!-- Composant d'entrée de mon application, c'est dans ce composant que les vues sont affichées -->


<!-- template html du composant -->
<template>
  <div id="app">

    <!-- Header de la page, s'affiche partout -->
    <header-logo></header-logo>
    <!-- La navigation, s'affiche partout -->
    <nav-menu></nav-menu>

    <!-- Le composant router-wiew se cahrge d'afficher les bons composants en fontion de la route appelée -->
    <!-- Les routes sont déclarées dans le fichier main.js -->
    <router-view></router-view>

    <!-- Le footer, commun a toutes les bages -->
    <dark-footer></dark-footer>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  // importe les composants nésaisaires
  import headerLogo from './components/HeaderLogo.vue'
  import navMenu from './components/NavMenu.vue'
  import darkFooter from './components/DarkFooter.vue'

  export default {
    name: 'app',
    components: { headerLogo, navMenu, darkFooter }
  }
</script>



<!-- style contient le style lié au composant -->
<style lang="scss">
  // j'importe les variables globales a mon site
  @import 'style/vars.scss';

  // ------------------------------------
  // Le style de mon composant
  #app{
    height: 100%;
    width: 100%;
  }
</style>
