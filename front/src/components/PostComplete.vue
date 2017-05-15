<!-- Composant PostComplete -->
<!-- Représente un post avec ses commentaires -->



<!-- template html du composant -->
<template>
  <div id="postcomplete">

    <div class="container">

      <div class="post-image">
        <img :src="post.poster.url" :alt="post.title">
      </div>

      <div class="post-text">
        <h1>{{ post.title }}</h1>
        <h2 class="date">{{ post.date }}</h2>
        <span></span>
        <p><strong>{{ post.hat }}</strong></p>
        <p class="infos">{{ post.content }}</p>
      </div>

    </div>

    <div class="container">
      <div class="comments">

        <h2>Commentaires</h2>

        <comment v-for="comment in comments" :comment="comment" :key="comment.id"></comment>

      </div>
    </div>

    <div class="container">
      <div class="comment-form">
        <h2>Ajoutez un commentaire</h2>

          <div v-if="failsComment == 'true'" class="errorsmessage">
            <ul>
              <li v-for="message in messagesComment">{{ message }}</li>
            </ul>
          </div>
          <div v-else-if="failsComment == 'false'" class="successmessage">
            <ul>
              <li v-for="message in messagesComment">{{ message }}</li>
            </ul>
          </div>

          <div class="input-group">
            <label for="newcomment">Commentez cet evenement !</label>
            <textarea id="newcomment" type="text" name="newcomment" v-model="newcomment" placeholder="Votre commentaire"></textarea>
          </div>

          <div class="input-group input-group-lg">
            <button type="button" name="submit" v-on:click="addcomment">Ajouter</button>
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
    props: ['slug'],
    components: { Comment },
    data () {
      return {
        post: {},
        comments: {},
        newcomment: "",
        failsComment: "nosubmit",
        messagesComment: []
      }
    },
    created () {
      // apele la methode chargée de charger les posts lorsque le composant est crée
      this.getPost()
    },
    methods: {
      // charge tous les posts de l'utilisateur connecté
      getPost () {
        // appel ajax pour récuperer le post concerné
        this.$http.get('/rest/postslug/' + this.slug).then((response) => {

          // si l'appel fonctionne bien, on transfere les posts recu aux composant
          //console.log(response.data)
          this.post = response.data[0]
          this.comments = response.data[0].comments
          //console.log(this.post)

        }, (response) => {

          console.log('Erreur lors de la requète au serveur')

        })
      },
      // charge tous les posts de l'utilisateur connecté
      getComments () {
        // appel ajax pour récuperer le post concerné
        this.$http.get('/rest/getComments/' + this.post.id).then((response) => {

          // si l'appel fonctionne bien, on transfere les posts recu aux composant
          //console.log(response.data)
          this.comments = response.data[0].comments
          //console.log(this.post)

        }, (response) => {

          console.log('Erreur lors de la requète au serveur')

        })
      },
      addcomment () {
        // appel ajax en POST grace a Vue-Resource
        this.$http.post('/rest/newcomment', {

          // les différentes valeurs a transmetre
          comment: this.newcomment,
          post: this.post.id

        }/*, {emulateJSON:true}*/).then((response) => {

          // s'execute si l'appel fonctionne bien
          this.messagesComment = []

          // si les infos on bien été mises a jour
          if(response.body.validation == false){
            // changement de couleur pour la zonne d'erreurs
            this.failsComment = "true"
            // liste tous les messages renvoyés par le serveur
            for(let error in response.data.messages){
              this.messagesComment.push(response.data.messages[error][0])
            }
          } else {
            // si le nouveau post n'est pas ajouté
            this.failsComment = "false"
            // liste les erreurs renvoyées par le serveur
            for(let error in response.data.messages){
              this.messagesComment.push(response.data.messages[error][0])
            }
            this.getComments()
          }
        }, (response) => {
          // si la requete au serveur a échoué
          this.failsComment = "true"
          this.messagesComment = []
          console.log('Le serveur est momentanément indisponible')
          this.messagesComment.push('Erreur lors de la requète.')
        })
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

        .errorsmessage{
          width: 100%;
          padding: 10px;
          background-color: #e74c3c;

          ul{
            margin: 0px;
            padding-left: 17px;
            li{
              margin: 3px;
              list-style: disc;
              font-family: 'DIN-alternate-medium';
            }
          }
        }

        .successmessage{
          width: 100%;
          padding: 10px;
          background-color: #27ae60;

          ul{
            margin: 0px;
            padding-left: 17px;
            li{
              margin: 3px;
              list-style: disc;
              font-family: 'DIN-alternate-medium';
            }
          }
        }

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
