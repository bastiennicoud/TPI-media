<!-- Composant MyProfile -->
<!-- Lorsque l'on accéder a ses informations pour les modifier-->



<!-- template html du composant -->
<template>
  <div id="myprofile">

    <div class="container">

      <div class="post-input-box">

        <h1>Mes informations</h1>

        <h2>Modifier votre nom d'utilisateur</h2>

        <div class="post-datas">

          <div v-if="failsName == 'true'" class="errorsmessage">
            <ul>
              <li v-for="message in messagesName">{{ message }}</li>
            </ul>
          </div>
          <div v-else-if="failsName == 'false'" class="successmessage">
            <ul>
              <li v-for="message in messagesName">{{ message }}</li>
            </ul>
          </div>

          <div class="input-group">
            <label for="name">Nouveau nom d'utilisateur</label>
            <input id="name" type="text" name="name" v-model="form.name" placeholder="Nom d'utilisateur">
          </div>

          <div class="input-group input-group-lg">
            <button type="button" name="submitname" v-on:click="submitName">Modifier mon nom d'utiliateur</button>
          </div>

        </div>

        <h2>Modifier votre e-mail</h2>

        <div class="post-datas">

          <div v-if="failsEmail == 'true'" class="errorsmessage">
            <ul>
              <li v-for="message in messagesEmail">{{ message }}</li>
            </ul>
          </div>
          <div v-else-if="failsEmail == 'false'" class="successmessage">
            <ul>
              <li v-for="message in messagesEmail">{{ message }}</li>
            </ul>
          </div>

          <div class="input-group">
            <label for="email">Nouvel e-mail</label>
            <input id="email" type="text" name="email" v-model="form.email" placeholder="E-mail">
          </div>

          <div class="input-group input-group-lg">
            <button type="button" name="submitemail" v-on:click="submitEmail">Modifier mon e-mail.</button>
          </div>

        </div>

        <h2>Modifier votre mot de passe</h2>

        <div class="post-datas">

          <div v-if="failsPassword == 'true'" class="errorsmessage">
            <ul>
              <li v-for="message in messagesPassword">{{ message }}</li>
            </ul>
          </div>
          <div v-else-if="failsPassword == 'false'" class="successmessage">
            <ul>
              <li v-for="message in messagesPassword">{{ message }}</li>
            </ul>
          </div>

          <div class="input-group">
            <label for="password_old">Votre actuel mot de passe</label>
            <input id="password_old" type="password" name="password_old" v-model="form.password_old" placeholder="Mot de passe">
          </div>

          <div class="input-group">
            <label for="password">Nouveau mot de passe (8 caractéres minimum)</label>
            <input id="password" type="password" name="password" v-model="form.password" placeholder="Mot de passe">
          </div>

          <div class="input-group">
            <label for="password_confirmation">Confirmez votre nouveau mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" v-model="form.password_confirmation" placeholder="Mot de passe">
          </div>

          <div class="input-group input-group-lg">
            <button type="button" name="submitpassword" v-on:click="submitPassword">Modifier le mot de passe</button>
          </div>

        </div>

      </div>

    </div>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  export default {
    name: 'myProfile',
    data () {
      return {
        form: {
          name: "",
          email: "",
          password_old: "",
          password: "",
          password_confirmation: ""
        },
        failsName: "nosubmit",
        messagesName: [],
        failsEmail: "nosubmit",
        messagesEmail: [],
        failsPassword: "nosubmit",
        messagesPassword: [],
      }
    },
    methods: {
      submitName () {
        // appel ajax en POST grace a Vue-Resource
        this.$http.post('/rest/modifyname', {

          // les différentes valeurs a transmetre
          name: this.form.name

        }/*, {emulateJSON:true}*/).then((response) => {

          // s'execute si l'appel fonctionne bien
          this.messagesName = []

          // si les infos on bien été mises a jour
          if(response.body.permission == true){
            // changement de couleur pour la zonne d'erreurs
            this.failsName = "false"
            // liste tous les messages renvoyés par le serveur
            for(let error in response.data.messages){
              this.messagesName.push(response.data.messages[error])
            }

            // on va modifier l'etat global de vue js pour y injecter les infos du nouvel utilisateur
            // j'utilise les mutations pour effectuer les changements de state
            // les muttations sont définiees dans le stores/AppStore.js
            this.$store.commit('USER_SETNAME', this.form.name)

            // je redirige l'utilisateur a la page d'acceuil
            //this.$router.push('/')
          } else {
            // si le nouveau nom n'est pas accepté
            this.failsName = "true"
            // liste les erreurs renvoyées par le serveur
            for(let error in response.data.messages){
              this.messagesName.push(response.data.messages[error][0])
            }
          }
        }, (response) => {
          // si la requete au serveur a échoué
          this.messagesName = []
          console.log('Le serveur est momentanément indisponible')
          this.messagesName.push('Erreur lors de la requète.')
        })
      },
      submitEmail() {
        // appel ajax en POST grace a Vue-Resource
        this.$http.post('/rest/modifyemail', {

          // les différentes valeurs a transmetre
          email: this.form.email

        }/*, {emulateJSON:true}*/).then((response) => {
console.log(response);
          // s'execute si l'appel fonctionne bien
          this.messagesEmail = []

          // si les infos on bien été mises a jour
          if(response.body.permission == true){
            // changement de couleur pour la zonne d'erreurs
            this.failsEmail = "false"
            // liste tous les messages renvoyés par le serveur
            for(let error in response.data.messages){
              this.messagesEmail.push(response.data.messages[error])
            }
          } else {
            // si le nouveau nom n'est pas accepté
            this.failsEmail = "true"
            // liste les erreurs renvoyées par le serveur
            for(let error in response.data.messages){
              this.messagesEmail.push(response.data.messages[error][0])
            }
          }
        }, (response) => {
          // si la requete au serveur a échoué
          this.messagesEmail = []
          console.log('Le serveur est momentanément indisponible')
          this.messagesEmail.push('Erreur lors de la requète.')
        })
      },
      submitPassword() {
      },
    }
  }
</script>



<!-- style contient le style lié au composant -->
<style lang="scss" scoped>
  // j'importe les variables globales a mon site
  @import '../style/vars.scss';

  // ------------------------------------
  // Le style de mon composant
  #myprofile{
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
          margin: 10px;
        }

        h2{
          width: 100%;
          margin: 10px;
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
          }
        }
      }

      @media(min-width: $tablet){
        width: 480px;
        margin: 0px auto;
      }
    }
  }
</style>
