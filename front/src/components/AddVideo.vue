<!-- Composant NewPost -->
<!-- Représente la page d'édition d'un nouvel article -->



<!-- template html du composant -->
<template>
  <div id="addvideo">

    <div class="container">

      <div class="post-input-box">

        <h1>Comment ajouter une vidéo</h1>
        <div class="infos">
          <p>Si vous souhaitez ajouter une vidéo a un de vos posts, certaines étapes sont nésaisaires.</p>
          <ul>
            <li>En premier il vous faut mettre en ligne votre vidéo sur youtube, avec un compte google.</li>
            <li>Une fois la vidéo en ligne, rendez vous sur la page de visionage de la vidéo.</li>
            <li>Sous votre vidéo, cliquez sur l'onglet partager.</li>
            <li>Un lien va apparaitre, il va falloir récuperer uniquement la partie après le dernier /.</li>
            <li>par exemple si vous obtenez https://youtu.be/3lXZRGlKl_8 il faut récuperer 3lXZRGlKl_8</li>
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
