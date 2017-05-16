<!-- Composant EventDate -->
<!-- Affiche les dates dans la side bar informations -->



<!-- template html du composant -->
<template>
  <div class="eventdate">

    <router-link :to="{name: 'Post', params: { slug: date.slug }}">
      <p><strong>{{date.date}}</strong></p>
      <p>{{date.title}}</p>
    </router-link>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  export default {
    name: 'eventDate',
    // les propriétes sont fournies par le composant parent lors de la génération de ce composant
    props: ['date']
  }
</script>



<!-- style contient le style lié au composant -->
<style lang="scss" scoped>
  // j'importe les variables globales a mon site
  @import '../style/vars.scss';

  // ------------------------------------
  // Le style de mon composant

  .eventdate{
    margin: 8px 0px;
    a{
      text-decoration: none;
    }
  }
</style>
