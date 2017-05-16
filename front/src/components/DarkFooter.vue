<!-- Composant DarkFooter -->
<!-- Dans ce composant tout ce qui concerne le footer -->



<!-- template html du composant -->
<template>
  <div id="darkfooter">

    <div class="container">

      <div class="column">
        <h3>Informations</h3>

        <div class="infoblock">
          <p><strong>Nos locaux:</strong></p>
          <p>Rue des Cygnes 10</p>
          <p>1400 Yverdon-les-Bains</p>
        </div>

        <div class="infoblock">
          <p><strong>Nous contacter:</strong></p>
          <p>079 222 33 33</p>
          <p>info@notresite.ch</p>
        </div>

      </div>

      <div class="column">
        <h3>Sponsors</h3>

        <div class="infoblock">
          <p>Loterie</p>
          <p>Une banque</p>
          <p>Une banque</p>
          <p>Une banque</p>
        </div>

      </div>

      <div class="mentions">
        <p>Réalisé dans le cadre de mon travail pratique de fin d'apprentissage.</p>
        <p>Bastien Nicoud, 2017</p>
      </div>

    </div>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  export default {
    name: 'darkFooter'
  }
</script>



<!-- style contient le style lié au composant -->
<style lang="scss" scoped>
  // j'importe les variables globales a mon site
  @import '../style/vars.scss';

  // ------------------------------------
  // Le style de mon composant
  #darkfooter{
    padding: 20px 10px 20px 10px;
    background-color: $grisFonce;

    .container{
      display: flex;
      flex-direction: column;
      justify-content: space-between;

      .column{
        h3{
          margin: 0px;
          font-size: 24px;
          color: $grisClair;
        }

        .infoblock{
          margin: 15px 0px;
          p{
            color: $grisClair;
            strong{
              color: $grisClair;
            }
          }
        }

        @media(min-width: $mobile){
          width: 50%;
        }
      }

      .mentions{
        text-align: center;
        width: 100%;
        p{
          color: $grisClair;
        }
      }

      @media(min-width: $mobile){
        flex-direction: row;
        flex-wrap: wrap;
      }

      @media(min-width: $large){
        width: 960px;
        margin: 0px auto;
        padding: 0px 10px;
      }
    }
  }
</style>
