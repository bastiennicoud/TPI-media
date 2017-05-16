<!-- Composant Comment -->
<!-- Représente un mmentaire -->



<!-- template html du composant -->
<template>
  <div class="comment">

    <img :src="comment.user.image" :alt="comment.user.name">

    <div class="comment-text">
      <p>{{comment.user.name}}</p>
      <p class="comment-content">{{comment.content}}</p>
      <p>{{comment.created_at}}</p>
      <img v-if="comment.image" :src="comment.image.url" :alt="comment.user.name">
    </div>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  export default {
    name: 'comment',
    props: ['comment']
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

      img{
        height: auto;
        width: 300px;
        max-width: 100%;
      }

      .comment-content{
        font-family: 'DIN-alternate-medium';
        font-size: 18px;
      }
    }

  }
</style>
