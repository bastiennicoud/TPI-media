<!-- Composant AddVidéo -->
<!-- Représente la page d'explication de la méthodologie pour ajouter une vidéo -->



<!-- template html du composant -->
<template>
  <div id="addvideo">

    <div class="container">

      <div class="post-input-box">

        <h1>Comment ajouter une vidéo</h1>
        <div class="infos">
          <p>Si vous souhaitez ajouter une vidéo à un de vos événements, certaines étapes sont nécessaires.</p>
          <ul>
            <li>Premièrement il vous faut mettre en ligne la vidéo sur Youtube, avec un compte Google.</li>
            <li>Une fois la vidéo en ligne, rendez-vous sur la page de visionnage de la vidéo.</li>
            <li>Sous votre vidéo, cliquez sur l'onglet "partager".</li>
            <li>Un lien va apparaitre, il va falloir récupérer uniquement la partie après le dernier / de l'url.</li>
            <li>Exemple: si vous obtenez "https://youtu.be/3lXZRGlKl_8" il vous faut récupérer "3lXZRGlKl_8".</li>
          </ul>
        </div>

      </div>

    </div>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  export default {
    name: 'addVideo',
  }
</script>



<!-- style contient le style lié au composant -->
<style lang="scss" scoped>
  // j'importe les variables globales a mon site
  @import '../style/vars.scss';

  // ------------------------------------
  // Le style de mon composant
  #addvideo{
    background-color: $blancFond;
    padding: 20px 0px;

    .container{
      margin: 0px 20px;
      box-sizing: border-box;

      .post-input-box{
        width: 100%;
        background-color: $grisClair;

        display: flex;
        flex-wrap: wrap;
        align-content: flex-start;

        h1{
          width: 100%;
          margin: 10px 10px;
        }

        .infos{
          width: 100%;
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
