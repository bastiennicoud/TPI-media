<!-- Composant Post -->
<!-- Représente un post -->



<!-- template html du composant -->
<template>
  <div class="post">

      <div class="post-image">
        <img src="/ressources/posters/affiche.jpg" alt="L'affiche du post">
      </div>

      <div class="post-text">
        <h2>Soirée JAM</h2>
        <p class="date">28 avril 2017</p>
        <span></span>
        <p><strong>Pour sa 5ème soirée JAM de l'année, le conservatoire vous fais découvrir les musiques typiques...</strong></p>
        <p class="infos">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  export default {
    name: 'post'
  }
</script>



<!-- style contient le style lié au composant -->
<style lang="scss" scoped>
  // j'importe les variables globales a mon site
  @import '../style/vars.scss';

  // ------------------------------------
  // Le style de mon composant

  .post{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-between;
    align-content: flex-start;
    align-items: flex-start;
    padding: 10px;

    .post-image{
      width: 29%;
      padding-right: 5px;

      img{
        width: 100%;
      }

      @media(max-width: $mobile){
        display: none;
      }
    }

    .post-text{
      width: 69%;

      display: flex;
      flex-direction: row;
      flex-wrap: wrap;

      padding-left: 5px;

      h2{
        width: 60%;
        margin: 0px;
        font-size: 24px;
      }

      .date{
        width: 40%;
        margin: 0px;
        text-align: right;
      }

      span{
        width: 100%;
        height: 0px;
        margin: 4px 0px;
        border-top: 2px solid $grisFonce;
      }

      p{
        width: 100%;
      }

      @media(max-width: $mobile){
        width: 100%;
        padding: 0px;
      }
    }
  }
</style>
