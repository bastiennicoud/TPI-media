<!-- Composant NewPost -->
<!-- Représente la page d'édition d'un nouvel article -->



<!-- template html du composant -->
<template>
  <div id="newpost">

    <div class="container">

      <div class="post-input-box">

        <h1>Créez un nouvel événement</h1>

        <div class="post-datas">

          <div class="input-group">
            <label for="title">Titre de l'événement (60 caractéres)</label>
            <input id="title" type="text" name="title" placeholder="Titre">
          </div>

          <div class="input-group">
            <label for="date">Date de votre événement</label>
            <input id="date" type="date" name="date">
          </div>

          <div class="input-group input-group-lg">
            <label for="texthat">Une accroche succinte a votre événement (env 2 lignes)</label>
            <textarea id="texthat" name="texthat" rows="3" cols="80" placeholder="Chapeau de votre post."></textarea>
          </div>

        </div>

        <div class="post-datas">
          <p id="label-drag-n-drop">Ajoutez une affiche pour votre événement (max 600 par 600px)</p>

          <!-- Ici j'utilise un composant permetant de faire de l'upload drag n drop -->
          <vue-clip id="drag-n-drop" :options="options">
            <template slot="clip-uploader-action">
              <div>
                <div class="dz-message"><p>Cliquez ou déposez pour ajouter votre image</p></div>
              </div>
            </template>

            <template slot="clip-uploader-body" scope="props">
              <div v-for="file in props.files">
                <img v-bind:src="file.dataUrl" />
              </div>
            </template>

          </vue-clip>
        </div>

        <div class="post-datas">

          <div class="input-group input-group-lg">
            <label for="content">Une description plus détaillée de votre événement</label>
            <textarea name="content" rows="10" cols="80" placeholder="La description de votre événement"></textarea>
          </div>

          <div class="input-group input-group-lg">
            <button type="button" name="button">Ajouter l'article</button>
          </div>

        </div>

      </div>

    </div>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  export default {
    name: 'newPost',
    data () {
      return {
        options: {
          url: '/upload',
          paramName: 'file'
        }
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
  #newpost{
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

        .post-datas{
          width: 100%;

          display: flex;
          flex-wrap: wrap;
          align-content: flex-start;

          background-color: $creme;

          // design des champs a remplir
          .input-group{
            box-sizing: border-box;
            width: 100%;
            padding: 10px;

            label{
              color: $placehoders;
              padding: 0px 4px;
              font-size: 18px;
              font-family: 'DIN-alternate-medium';
            }

            input{
              box-sizing: border-box;
              -webkit-appearance: none;
              border-radius: 0px;
              background: transparent;
              width: 100%;
              height: 34px;

              padding: 5px 4px;

              border: none;
              border-bottom: 2px solid $placehoders;

              font-size: 22px;

              transition: all 0.4s;

              &::placeholder{
                color: $placehoders;
              }

              &:focus{
                outline: none;

                color: $grisFonce;
                border-color: $grisFonce;
              }

              &:hover{
                background-color: $grisClair;

                border-color: $grisFonce;

              }
            }

            textarea{
              box-sizing: border-box;
              display: block;
              -webkit-appearance: none;
              border-radius: 0px;
              background: transparent;
              width: 100%;

              padding: 5px 4px;

              border: none;
              border-bottom: 2px solid $placehoders;

              font-size: 22px;

              transition: all 0.4s;

              &::placeholder{
                color: $placehoders;
              }

              &:focus{
                outline: none;

                color: $grisFonce;
                border-color: $grisFonce;
              }

              &:hover{
                background-color: $grisClair;

                border-color: $grisFonce;

              }
            }

            button{
              box-sizing: border-box;
              display: block;
              -webkit-appearance: none;
              border-radius: 0px;
              border: none;

              margin: 0px auto;
              padding: 10px 20px;

              color: $grisFonce;
              background-color: $grisClair;

              transition: all 0.4s;

              &:hover{
                color: $grisClair;
                background-color: $grisFonce;
              }
            }

            @media(min-width: $tablet){
              width: 50%;
            }
          }

          .input-group-lg{
            width: 100%;
          }

          #label-drag-n-drop{
            margin: 10px 10px 0px 10px;
            font-family: 'DIN-alternate-medium';
            color: $placehoders;
          }

          #drag-n-drop{
            box-sizing: border-box;
            width: 100%;
            margin: 10px;
            padding: 10px;
            text-align: center;
            background-color: $grisClair;

            border: 1px dashed $grisFonce;
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
