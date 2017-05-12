<!-- Composant Login -->
<!-- Lorsque l'on souhaite s'enregistrer sur le site -->



<!-- template html du composant -->
<template>
  <div id="login">

    <div class="container">

      <div class="post-input-box">

        <h1>Connectez vous !</h1>

        <div class="post-datas">

          <div v-if="fails == 'true'" class="errorsmessage">
            <ul>
              <li v-for="message in messages">{{ message }}</li>
            </ul>
          </div>
          <div v-else-if="fails == 'false'" class="successmessage">
            <ul>
              <li v-for="message in messages">{{ message }}</li>
            </ul>
          </div>

          <div class="input-group">
            <label for="username">Votre nom d'utilisateur</label>
            <input id="username" type="text" name="username" v-model="form.name" placeholder="Nom d'utilisateur">
          </div>

          <div class="input-group">
            <label for="password">Votre mot de passe</label>
            <input id="password" type="password" name="password" v-model="form.password" placeholder="Mot de passe">
          </div>

          <!--<div class="input-group">
            <input id="remember" type="checkbox" name="remember" v-model="form.remember">Se souvenir de moi</input>
          </div>-->

          <div class="input-group input-group-lg">
            <button type="button" name="submit" v-on:click="submit">Valider</button>
          </div>

        </div>

      </div>

    </div>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  export default {
    name: 'login',
    data () {
      return {
        form: {
          name: "",
          password: ""
        },
        fails: "nosubmit",
        messages: []
      }
    },
    methods: {
      submit () {
        console.log('La methode est appelée');


        // appel ajax en POST grace a Vue-Resource
        this.$http.post('/rest/login', {

          // les différentes valeurs a transmetre
          name: this.form.name,
          password: this.form.password

        }/*, {emulateJSON:true}*/).then((response) => {

          // s'execute si l'appel fonctionne bien
          console.log(response)

          this.messages = []

          if(response.body == true){
            this.fails = "false"
            this.messages.push('Vous avec correctement été connectés.')
            window.location.href = '/lastposts'
          } else {
            this.fails = "true"
            this.messages.push('Les informations renseignées sont erronées')
          }


        }, (response) => {

          this.messages = []
          console.log('Erreur lors de la requète au serveur')
          this.messages.push('Erreur lors de la requète.')

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
  #login{
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
