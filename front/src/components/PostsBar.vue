<!-- Composant PostsBar -->
<!-- Concerne le composant qui affiche tous les articles -->



<!-- template html du composant -->
<template>
  <div id="postsbar">


      <h1>Actualité</h1>

      <!-- le composant post affiche les posts -->
      <post v-for="post in posts" :post="post" :key="post.id"></post>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  // importe les composants nésaisaires
  import post from './Post.vue'

  export default {
    name: 'postsBar',
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
        this.$http.get('/rest/postsbydate').then((response) => {

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
