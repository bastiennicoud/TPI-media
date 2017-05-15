<!-- Composant Post -->
<!-- Représente un post -->



<!-- template html du composant -->
<template>
  <div class="post">

      <div class="post-image">
        <router-link :to="{name: 'Post', params: { id: post.slug }}">
          <img :src="post.poster.url" :alt="post.title">
        </router-link>
      </div>

      <div class="post-text">
        <router-link :to="{name: 'Post', params: { id: post.slug }}">
          <h2>{{ post.title }}</h2>
          <p class="date">{{ post.date }}</p>
        </router-link>
        <span></span>
        <p><strong>{{ post.hat }}</strong></p>
        <p class="infos">{{ post.content }}</p>
      </div>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  export default {
    name: 'post',
    props: ['post'],
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
        text-decoration: none;
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
