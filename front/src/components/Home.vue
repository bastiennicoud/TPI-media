<!-- Composant Home -->
<!-- Composant du contenu de la page d'acceuil -->



<!-- template html du composant -->
<template>
  <div id="home">

    <div class="container">

      <information-bar></information-bar>

      <posts-bar></posts-bar>

    </div>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  // importe les composants nésaisaires
  import informationBar from './InformationBar.vue'
  import postsBar from './PostsBar.vue'

  export default {
    name: 'home',
    components: { informationBar, postsBar }
  }
</script>



<!-- style contient le style lié au composant -->
<style lang="scss" scoped>
  // j'importe les variables globales a mon site
  @import '../style/vars.scss';

  // ------------------------------------
  // Le style de mon composant

  #home{
    background-color: $blancFond;
    .container{
      display: flex;
      flex-direction: row;
      justify-content: space-between;

      #informationbar{
        width: 30%;
        margin: 20px 10px 20px 0px;
      }

      #postsbar{
        width: 70%;
        margin: 20px 0px 20px 10px;
      }

      @media(min-width: $large){
        width: 960px;
        margin: 0px auto;
      }

      // on masque la bare d'infos sur mobiles
      #informationbar{
        @media(max-width: $tablet){
          display: none;
        }
      }

      #postsbar{
        @media(max-width: $tablet){
          width: 100%;
          margin: 20px 20px 20px 20px;
        }
      }
    }
  }
</style>
