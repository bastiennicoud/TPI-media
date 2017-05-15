<!-- Composant MyPosts -->
<!-- Page qui liste les derniers articles postés -->



<!-- template html du composant -->
<template>
  <div id="myposts">

    <div class="container">

      <div id="postslist">

        <h1>Mes posts</h1>

        <!-- pour chaque post je crée un composant post-edit -->
        <post-edit v-for="post in posts" :post="post" :key="post.id" v-on:deletedPost="hideDeleted"></post-edit>
        <div class="noposts" v-if="!posts[0]">
          <h2>Vous n'avez pas encore ajouté d'événements</h2>
        </div>

      </div>

    </div>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  // importe les composants nésaisaires
  import postEdit from './PostEdit.vue'

  export default {
    name: 'myPosts',
    components: { postEdit },
    data () {
      return {
        posts: {}
      }
    },
    created () {
      // apele la methode chargée de charger les posts lorsque le composant est crée
      this.getDatas()
    },
    methods: {
      // charge tous les posts de l'utilisateur connecté
      getDatas () {
        // appel ajax en POST grace a Vue-Resource
        this.$http.get('/rest/postsuser').then((response) => {

          // si l'appel fonctionne bien, on transfere les posts recu aux composant
          this.posts = response.data

        }, (response) => {

          console.log('Erreur lors de la requète au serveur')

        })
      },
      // cette methode est appelé si on supprime un post
      hideDeleted (id) {
        // appel ajax en POST grace a Vue-Resource
        // on va recharger les posts
        this.$http.get('/rest/postsuser').then((response) => {

          // si l'appel fonctionne bien, on transfere les posts recu aux composant
          this.posts = response.data

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
  #myposts{
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

        .postedit{
          &:nth-child(even){
            background-color: $creme;
          }
        }
        .noposts{
          background-color: $creme;
          padding: 10px;
        }
      }

      @media(min-width: $large){
        width: 960px;
        margin: 0px auto;
      }
    }
  }
</style>
