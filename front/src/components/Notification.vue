<!-- Composant LastPosts -->
<!-- Page qui liste les derniers articles postés -->



<!-- template html du composant -->
<template>
  <div id="lastposts">

    <div class="container">

      <div id="postslist">

        <h1>{{ userNotification }} Evénements dans la semaine</h1>

        <!-- le composant post affiche les posts -->
        <post v-for="post in posts" :post="post" :key="post.id"></post>

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
    components: { post },
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
        this.$http.get('/rest/postsweek').then((response) => {

          // si l'appel fonctionne bien, on transfere les posts recu aux composant
          this.posts = response.data

        }, (response) => {

          console.log('Erreur lors de la requète au serveur')

        })
      }
    },
    computed: {
      // retourne le monbre de notifications
      userNotification () {
        return this.$store.getters.userNotification
      },
    }
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
