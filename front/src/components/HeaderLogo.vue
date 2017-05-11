<!-- Composant HeaderLogo -->
<!-- Composant conteneant le header des pages avec le logo -->



<!-- template html du composant -->
<template>
  <div id="headerlogo">

    <div class="container">

      <router-link :to="{name: 'Home'}">
        <img src="../assets/logos/Logo.svg" alt="Logo du CMNV">
      </router-link>
      <p>Conservatoire de<br> Musique du Nord Vaudois</p>

    </div>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  export default {
    name: 'headerLogo'
  }
</script>



<!-- style contient le style lié au composant -->
<style lang="scss" scoped>
  // j'importe les variables globales a mon site
  @import '../style/vars.scss';

  // ------------------------------------
  // Le style de mon composant
  #headerlogo{
    padding: 20px 10px 20px 10px;
    background-color: $grisFonce;

    .container{
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;

      a{
        img{
          width: 300px;
        }
      }

      p{
        width: 270px;

        margin-top: 16px;
        margin-bottom: 0px;

        text-align: center;

        color: $grisClair;
        font-family: 'Futura-medium';
        font-size: 20px;
      }

      @media(min-width: $mobile){
        flex-direction: row;
        justify-content: space-between;
        align-items: flex-end;

        p{
          text-align: right;
        }
      }

      @media(min-width: $large){
        width: 960px;
        margin: 0px auto;
      }
    }
  }
</style>
