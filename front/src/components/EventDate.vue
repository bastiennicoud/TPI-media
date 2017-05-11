<!-- Composant EventDate -->
<!-- Affiche les dates dans la side bar informations -->



<!-- template html du composant -->
<template>
  <div class="eventdate">

    <p><strong>28 avril 2017</strong></p>
    <p>Soirée JAM</p>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  export default {
    name: 'eventDate'
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
  }
</style>
