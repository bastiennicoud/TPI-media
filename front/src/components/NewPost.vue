<!-- Composant NewPost -->
<!-- Représente la page d'édition d'un nouvel article -->



<!-- template html du composant -->
<template>
  <div id="newpost">

    <div class="container">

      <div class="post-input-box">

        <h1>Créez un nouvel événement</h1>

        <div class="post-datas">

          <div v-if="failsPost == 'true'" class="errorsmessage">
            <ul>
              <li v-for="message in messagesPost">{{ message }}</li>
            </ul>
          </div>
          <div v-else-if="failsPost == 'false'" class="successmessage">
            <ul>
              <li v-for="message in messagesPost">{{ message }}</li>
            </ul>
          </div>

          <div class="input-group">
            <label for="title">Titre de l'événement (60 caractéres)</label>
            <input id="title" type="text" name="title" v-model="form.title" placeholder="Titre">
          </div>

          <div class="input-group">
            <label for="date">Date de votre événement</label>
            <input id="date" type="date" v-model="form.date" name="date">
          </div>

          <div class="input-group input-group-lg">
            <label for="texthat">Une accroche succinte a votre événement (env 2 lignes)</label>
            <textarea id="texthat" name="texthat" rows="3" cols="80" v-model="form.hat" placeholder="Chapeau de votre post."></textarea>
          </div>

        </div>

        <div class="post-datas">

          <p id="label-drag-n-drop">Ajoutez une affiche pour votre événement max 1mo</p>

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
            <textarea name="content" rows="10" cols="80" v-model="form.body" placeholder="La description de votre événement"></textarea>
          </div>

          <div class="input-group input-group-lg">
            <button type="button" name="button" v-on:click="submit">Ajouter l'article</button>
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
    // -------------------------------------------------------------
    // data retourne toutes les variables liées a ce composant
    data () {
      return {
        // stoque touts les données inserées dans les inputs
        form: {
          title: "",
          date: "",
          hat: "",
          body: "",
          idimage: "2"
        },
        // pour gerer les différentes erreurs
        failsPost: "nosubmit",
        messagesPost: [],
        failsImage: "nosubmit",
        messagesImage: [],
        // les options pour le composant d'upload
        options: {
          url: '/rest/addposter',
          paramName: 'poster',
          uploadMultiple: 0,
          maxFilesize: {
            limit: 1,
            message: '{{ filesize }} votre ficher est trop grand {{ maxFilesize }}'
          }
        }
      }
    },
    methods: {
      // lorsque l'on soumet le nouvel article
      submit () {
        // appel ajax en POST grace a Vue-Resource
        this.$http.post('/rest/post', {

          // les différentes valeurs a transmetre
          title: this.form.title,
          date: this.form.date,
          hat: this.form.hat,
          body: this.form.body,
          idimage: this.form.idimage

        }/*, {emulateJSON:true}*/).then((response) => {

          // s'execute si l'appel fonctionne bien
          this.messagesPost = []

          // si les infos on bien été mises a jour
          if(response.body.validation == false){
            // changement de couleur pour la zonne d'erreurs
            this.failsPost = "true"
            // liste tous les messages renvoyés par le serveur
            for(let error in response.data.messages){
              this.messagesPost.push(response.data.messages[error][0])
            }
          } else {
            // si le nouveau post n'est pas ajouté
            this.failsPost = "false"
            // liste les erreurs renvoyées par le serveur
            for(let error in response.data.messages){
              this.messagesPost.push(response.data.messages[error][0])
            }

            // je redirige l'utilisateur a la page d'acceuil
            this.$router.push('/myposts')
          }
        }, (response) => {
          // si la requete au serveur a échoué
          this.messagesName = []
          console.log('Le serveur est momentanément indisponible')
          this.messagesName.push('Erreur lors de la requète.')
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
            this.form.idimage = response.imageid
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
