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
        <iframe v-if="post.video" v-bind:src="'https://www.youtube.com/embed/' + post.video" frameborder="0" allowfullscreen></iframe>
      </div>

    </div>

    <div class="container">
      <div class="comments">

        <h2>Commentaires</h2>

        <comment v-for="comment in comments" :comment="comment" :key="comment.id"></comment>
        <div class="nocomments" v-if="!comments[0]">
          <h3>Il n'y a pas encore de commentaires ! Ajouter en un !</h3>
        </div>

      </div>
    </div>

    <div class="container">
      <div class="comment-form">
        <h2>Ajouter un commentaire</h2>

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
            <label for="newcomment">Commentez l'événement</label>
            <textarea id="newcomment" type="text" name="newcomment" v-model="newcomment" placeholder="Votre commentaire"></textarea>
          </div>

          <p id="label-drag-n-drop">Vous pouvez ajouter une image à votre commentaire</p>

          <div v-if="failsImage == 'true'" class="errorsmessage">
            <ul>
              <li v-for="message in messagesImage">{{ message }}</li>
            </ul>
          </div>
          <div v-else-if="failsImage == 'false'" class="successmessage">
            <ul>
              <li v-for="message in messagesImage">{{ message }}</li>
            </ul>
          </div>

          <!-- Ici j'utilise un composant permetant de faire de l'upload drag n drop -->
          <vue-clip id="drag-n-drop" :options="options" :on-complete="complete">

            <template slot="clip-uploader-action">
              <div>
                <div class="dz-message"><p>Cliquez ou déposez si vous souhaitez ajouter une image</p></div>
              </div>
            </template>

            <template slot="clip-uploader-body" scope="props">
              <div v-for="file in props.files">
                <img v-bind:src="file.dataUrl" />
              </div>
            </template>

          </vue-clip>

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
        post: {
          poster:{
            url: ""
          }
        },
        comments: {},
        newcomment: "",
        idimage: "",
        failsComment: "nosubmit",
        messagesComment: [],
        failsImage: "nosubmit",
        messagesImage: [],
        // les options pour le composant d'upload
        options: {
          url: '/rest/addcommentimage',
          paramName: 'image',
          uploadMultiple: 0,
          maxFilesize: {
            limit: 1,
            message: '{{ filesize }} votre ficher est trop grand {{ maxFilesize }}'
          }
        }
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

        }, (response) => {

          console.log('Erreur lors de la requète au serveur')

        })
      },
      // charge tous les posts de l'utilisateur connecté
      getComments () {
        // appel ajax pour récuperer le post concerné
        this.$http.get('/rest/getcomments/' + this.post.id).then((response) => {

          // si l'appel fonctionne bien, on transfere les posts recu aux composant
          this.comments = response.data

        }, (response) => {

          console.log('Erreur lors de la requète au serveur')

        })
      },
      // l'orsque l'on soumme tun nouveau commentaire
      addcomment () {
        // appel ajax en POST grace a Vue-Resource
        this.$http.post('/rest/newcomment', {

          // les différentes valeurs a transmetre
          comment: this.newcomment,
          post: this.post.id,
          idimage: this.idimage

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
            this.newcomment = ""
            this.getComments()
          }
        }, (response) => {
          // si la requete au serveur a échoué
          this.failsComment = "true"
          this.messagesComment = []
          console.log('Le serveur est momentanément indisponible')
          this.messagesComment.push('Erreur lors de la requète.')
        })
      },
      // methods lorsque le composant vue clip a recu une réponse
      complete (file, status, xhr) {

        // je vide le tableau contenant les erreurs liées a l'image
        this.messagesImage = []

        // si le serveur renvoie une erreur
        if(status == 'error'){
          // changement de couleur pour la zonne d'erreurs
          this.failsImage = "true"
          // Affiche une erreur
          this.messagesImage.push("Votre image n'a pas pu être enregistrée")
        } else {
          // si le serveur a bien répondu
          // il faut convertir sa réponse en json, en effet, le composant qui se charge de faire l'upload
          // nous retoure l'objet XHR brut de javascript, ou la reponse est sous forme de texte
          let response = JSON.parse(xhr.responseText)

          // on teste si le serveur nous renvoie que l'on a pas la permission de cette action
          if(response.permission == false) {
            // dans ce cas on change la couleur
            this.failsImage = "true"
            // liste les erreurs renvoyées par le serveur
            for(let error in response.messages){
              this.messagesImage.push(response.messages[error][0])
            }
          } else {
            // dans ce cas on change la couleur
            this.failsImage = "false"
            // liste les erreurs renvoyées par le serveur
            this.idimage = response.imageid
            for(let error in response.messages){
              this.messagesImage.push(response.messages[error][0])
            }
          }
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

        iframe{
          width: 100%;
          height: 320px;
          margin-top: 20px;

          @media(max-width: $tablet){
            height: 200px;
          }

          @media(max-width: $mobile){
            height: 300px;
          }
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

        .nocomments{
          background-color: $grisClair;
          margin: 10px;
          padding: 10px;
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
  }
</style>
