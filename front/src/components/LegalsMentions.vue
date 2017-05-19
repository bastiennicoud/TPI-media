<!-- Composant LastPosts -->
<!-- Page qui liste les derniers articles postés -->



<!-- template html du composant -->
<template>
  <div id="legalsmentions">

    <div class="container">

      <div id="text">

        <h1>Mentions légales</h1>

        <div class="text">
          <p>Application web réalisée dans le cadre du travail pratique individuel de fin d'apprentissage de médiamatitien.</p>
          <p>Cette application n'est ni oficielle ni a but commerciale.</p>
          <p>Les utilisateurs sont responsables des médias postées et le CMNV ne peut en aucun cas être porté responsable en cas de droits d'auteurs violés.</p>
        </div>

      </div>

    </div>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  // importe les composants nésaisaires
  import post from './Post.vue'

  export default {
    name: 'legalsmentions'
  }
</script>



<!-- style contient le style lié au composant -->
<style lang="scss" scoped>
  // j'importe les variables globales a mon site
  @import '../style/vars.scss';

  // ------------------------------------
  // Le style de mon composant
  #legalsmentions{
    padding: 20px;
    background-color: $blancFond;

    .container{
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      background-color: $grisClair;

      #text{
        width: 100%;

        h1{
          margin: 10px;
        }

        .text{
          padding: 10px;
          background-color: $creme;
        }
      }

      @media(min-width: $large){
        width: 960px;
        margin: 0px auto;
      }
    }
  }
</style>
