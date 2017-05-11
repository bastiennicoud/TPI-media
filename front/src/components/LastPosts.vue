<!-- Composant LastPosts -->
<!-- Page qui liste les derniers articles postés -->



<!-- template html du composant -->
<template>
  <div id="lastposts">

    <div class="container">

      <div id="postslist">

        <h1>Derniers posts</h1>

        <!-- le composant post affiche les posts -->
        <post></post>
        <post></post>
        <post></post>
        <post></post>
        <post></post>
        <post></post>

      </div>

    </div>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  // importe les composants nésaisaires
  import post from './Post.vue'

  export default {
    name: 'lastPosts',
    components: { post }
  }
</script>



<!-- style contient le style lié au composant -->
<style lang="scss" scoped>
  // j'importe les variables globales a mon site
  @import '../style/vars.scss';

  // ------------------------------------
  // Le style de mon composant
  #lastposts{
    background-color: $blancFond;

    .container{
      padding: 20px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;

      #postslist{
        width: 100%;
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

      @media(min-width: $large){
        width: 960px;
        margin: 0px auto;
      }
    }
  }
</style>
