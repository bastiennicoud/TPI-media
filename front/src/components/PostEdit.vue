<!-- Composant PostEdit -->
<!-- Composant du contenu de la page d'acceuil -->



<!-- template html du composant -->
<template>
  <div class="postedit">

      <div class="post-image">
        <img :src="post.poster.url" :alt="post.title">
      </div>

      <div class="post-text">
        <h2>{{ post.title }}</h2>
        <p class="date">{{ post.date }}</p>
        <span></span>
        <p><strong>{{ post.hat }}</strong></p>
        <p class="infos">{{ post.content }}</p>

        <div class="post-edit-options">
          <button type="button" name="editpost" v-on:click="editPost">Editer l'article</button>
          <button type="button" name="deletepost" v-on:click="deletePost">Supprimer l'article</button>
          <button v-if="post.online" type="button" name="deletepost" v-on:click="makeOnline">Mettre hors ligne</button>
          <button v-else type="button" name="deletepost" v-on:click="makeOnline">Mettre en ligne</button>
        </div>
      </div>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  export default {
    name: 'postEdit',
    props: ['post'],
    methods: {
      editPost () {
        this.$router.push({ name: 'EditPost', params: { postId: this.post.id }})
      },
      deletePost () {
        // appel ajax en POST grace a Vue-Resource
        // on lui passe l'id du post a supprimer
        this.$http.delete('/rest/post/' + this.post.id).then((response) => {

          // si la ressource est bien supprimée, j'emmet un evenement de nom close
          // le composant parent va pouvoir le détecter et mettre a jour la vue
          // pour suprimer le post qui viend d'étre supprimé
          this.$emit('deletedPost')

        }, (response) => {

          console.log('Erreur lors de la requète au serveur')

        })
      },
      makeOnline () {
        // appel ajax en POST grace a Vue-Resource
        // on lui passe l'id du post a supprimer
        this.$http.patch('/rest/postonline/' + this.post.id).then((response) => {

          if(response.body == true){
            this.post.online = !this.post.online
          } else {
            console.log('Erreur lors de la requète au serveur')
          }

        }, (response) => {

          console.log('Erreur lors de la requète au serveur')

        })
      }
    }
  }
</script>



<!-- style contient le style lié au composant -->
<style lang="scss" scoped>
  // j'importe les variables globales a mon site
  @import '../style/vars.scss';

  // ------------------------------------
  // Le style de mon composant

  .postedit{
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

      .post-edit-options{
        button{
          box-sizing: border-box;
          display: inline-block;
          -webkit-appearance: none;
          border-radius: 0px;
          border: none;

          margin: 10px auto;
          padding: 10px 20px;

          color: $grisFonce;

          transition: all 0.4s;

          &:hover{
            color: $grisClair;
            background-color: $grisFonce !important;
          }

          &:nth-child(1){
            background-color: lighten(#2980b9, 10%);
          }

          &:nth-child(2){
            background-color: lighten(#e74c3c, 10%);
          }

          &:nth-child(3){
            background-color: #1abc9c;
          }
        }
      }

      @media(max-width: $mobile){
        width: 100%;
        padding: 0px;
      }
    }
  }
</style>
