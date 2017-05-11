<!-- Composant PostsBar -->
<!-- Concerne le composant qui affiche tous les articles -->



<!-- template html du composant -->
<template>
  <div id="postsbar">


      <h1>Actualité</h1>

      <!-- le composant post affiche les posts -->
      <post></post>
      <post></post>
      <post></post>
      <post></post>
      <post></post>
      <post></post>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  // importe les composants nésaisaires
  import post from './Post.vue'

  export default {
    name: 'postsBar',
    components: { post }
  }
</script>



<!-- style contient le style lié au composant -->
<style lang="scss" scoped>
  // j'importe les variables globales a mon site
  @import '../style/vars.scss';

  // ------------------------------------
  // Le style de mon composant
  #postsbar{
    background-color: $grisClair;

    h1{
      margin: 10px 14px;
    }

    .post{
      &:nth-child(even){
        background-color: $creme;
      }
    }
  }
</style>
