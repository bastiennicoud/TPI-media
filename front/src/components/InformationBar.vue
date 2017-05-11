<!-- Composant InformationBar -->
<!-- Concerne le composant qui affiche tous les articles -->



<!-- template html du composant -->
<template>
  <div id="informationbar">

    <p class="title">Informations</p>

    <div class="month-events">
      <h2>Evenements du mois</h2>
      <span></span>
      <event-date></event-date>
      <event-date></event-date>
      <event-date></event-date>
      <event-date></event-date>
    </div>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  // importe les composants nésaisaires
  import eventDate from './EventDate.vue'

  export default {
    name: 'InformationBar',
    components: { eventDate }
  }
</script>



<!-- style contient le style lié au composant -->
<style lang="scss" scoped>
  // j'importe les variables globales a mon site
  @import '../style/vars.scss';

  // ------------------------------------
  // Le style de mon composant
  #informationbar{
    background-color: $grisClair;

    .title{
      font-family: 'Futura-medium';
      font-size: 36px;
      margin: 10px 14px;
    }

    .month-events{
      padding: 10px;
      background-color: $creme;

      h2{
        margin: 0px;
        font-size: 24px;
      }

      span{
        display: block;
        width: 100%;
        height: 0px;
        margin: 6px 0px 14px 0px;
        border-top: 2px solid $grisFonce;
      }
    }
  }
</style>
