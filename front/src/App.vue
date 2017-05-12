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

  // importation du store global de l'application
  import store from './stores/AppStore.js'

  export default {
    store: store,
    name: 'app',
    components: { headerLogo, navMenu, darkFooter },
    created () {
      // lorsque le composant est crée par vue js, j'effectue un appel ajax au serveur pour savoir
      // si un utilisateur est actuellement connecté

      // appel ajax en POST grace a Vue-Resource
      this.$http.post('/rest/user').then((response) => {

        // si un utilisateur est bien connecté
        if(response.body.connected == true){
          // on va modifier l'etat global de vue js pour y injecter les infos du nouvel utilisateur
          // j'utilise les mutations pour effectuer les changements de state
          // les muttations sont définiees dans le stores/AppStore.js
          this.$store.commit('USER_CONNECT')
          this.$store.commit('USER_SETNAME', response.body.username)
          this.$store.commit('USER_SETPHOTO', response.body.userimage)
          this.$store.commit('USER_SETROLE', response.body.userrole)
        } else {
          // si aucun utilisateur n'est connecté
          // on mute notre state pour que tous les composant s'adapte
          this.$store.commit('USER_DISCONNECT')
        }


      }, (response) => {

        console.log('Erreur lors de la requète au serveur')

      })

    }
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
