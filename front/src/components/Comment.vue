<!-- Composant Comment -->
<!-- Représente un mmentaire -->



<!-- template html du composant -->
<template>
  <div class="comment">

    <img src="/ressources/profilephotos/lego.jpg" alt="Photo de profile">

    <div class="comment-text">
      <p>Bastien Nicoud</p>
      <p class="comment-content">Un commentaire bidon pour mettre en page mes commentaires</p>
      <p>Posté le 28.2.2</p>
    </div>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  export default {
    name: 'comment'
  }
</script>



<!-- style contient le style lié au composant -->
<style lang="scss" scoped>
  // j'importe les variables globales a mon site
  @import '../style/vars.scss';

  // ------------------------------------
  // Le style de mon composant

  .comment{
    padding: 10px;

    display: flex;

    img{
      width: 60px;
      height: 60px;
    }

    .comment-text{
      margin-left: 10px;

      p{
        font-size: 16px;
      }

      .comment-content{
        font-family: 'DIN-alternate-medium';
        font-size: 18px;
      }
    }

  }
</style>
