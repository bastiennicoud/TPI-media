<!-- Composant PostComplete -->
<!-- Représente un post avec ses commentaires -->



<!-- template html du composant -->
<template>
  <div id="postcomplete">

    <div class="container">

      <div class="post-image">
        <img src="/ressources/posters/affiche.jpg" alt="L'affiche du post">
      </div>

      <div class="post-text">
        <h1>{{id}}</h1>
        <h2 class="date">28 avril 2017</h2>
        <span></span>
        <p><strong>Pour sa 5ème soirée JAM de l'année, le conservatoire vous fais découvrir les musiques typiques...</strong></p>
        <p class="infos">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>

    </div>

    <div class="container">
      <div class="comments">

        <h2>Commentaires</h2>

        <comment></comment>
        <comment></comment>
        <comment></comment>
        <comment></comment>

      </div>
    </div>

    <div class="container">
      <div class="comment-form">
        <h2>Ajoutez un commentaire</h2>

          <div class="input-group">
            <label for="newcomment">Commentez cet evenement !</label>
            <textarea id="newcomment" type="text" name="newcomment" placeholder="Votre commentaire"></textarea>
          </div>

          <div class="input-group input-group-lg">
            <button type="button" name="submit">Ajouter</button>
          </div>

      </div>
    </div>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  import Comment from './Comment.vue'

  export default {
    name: 'postComplete',
    props: ['id'],
    components: { Comment }
  }
</script>



<!-- style contient le style lié au composant -->
<style lang="scss" scoped>
  // j'importe les variables globales a mon site
  @import '../style/vars.scss';

  // ------------------------------------
  // Le style de mon composant

  #postcomplete{
    padding: 20px 20px;
    background-color: $blancFond;
    .container{
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      justify-content: space-between;

      padding: 10px;

      background-color: $grisClair;

      .post-image{
        width: 100%;
        padding-bottom: 10px;

        img{
          width: 100%;
        }

        @media(min-width: $mobile){
          width: 39%;
          padding-right: 5px;
        }
      }

      .post-text{
        width: 59%;

        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-content: flex-start;

        padding-left: 5px;

        h1{
          width: 60%;
          margin: 0px;
          font-size: 24px;
        }

        .date{
          width: 40%;
          margin: 0px;
          text-align: right;
        }

        span{
          width: 100%;
          height: 0px;
          margin: 4px 0px;
          border-top: 2px solid $grisFonce;
        }

        p{
          width: 100%;
        }

        @media(max-width: $mobile){
          width: 100%;
          padding: 0px;
        }
      }

      @media(min-width: $mobile){
        flex-direction: row;
      }

      @media(min-width: $large){
        width: 960px;
        margin: 0px auto;
      }

      .comments{
        width: 100%;
        background-color: $creme;

        h2{
          font-size: 24px;
          margin: 10px;
        }
        .comment{
          &:nth-child(even){
            background-color: $grisClair;
          }
        }
      }

      .comment-form{
        width: 100%;
        background-color: $creme;

        display: flex;
        flex-wrap: wrap;
        align-content: flex-start;

        h2{
          font-size: 24px;
          margin: 10px;
        }

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
        }
      }
    }
  }
</style>
