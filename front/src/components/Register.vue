<!-- Composant Rgister -->
<!-- Lorsque l'on souhaite s'enregistrer sur le site -->



<!-- template html du composant -->
<template>
  <div id="register">

    <div class="container">

      <div class="post-input-box">

        <h1>Inscrivez vous !</h1>

        <div class="post-datas">

          <div class="errorsmessage">
            <ul>
              <li v-for="error in errors">{{ error }}</li>
            </ul>
          </div>

          <div class="input-group" :class="status.name">
            <label for="username">C'est ce nom qui sera visible sur le site</label>
            <input id="username" type="text" name="username" v-model="form.name" placeholder="Nom d'utilisateur">
          </div>

          <div class="input-group" :class="status.email">
            <label for="email">Une adresse e-mail valide</label>
            <input id="email" type="text" name="email" v-model="form.email" placeholder="E-mail">
          </div>

          <div class="input-group" :class="status.password">
            <label for="password">Mot de passe (8 caractéres minimum)</label>
            <input id="password" type="password" name="password" v-model="form.password" placeholder="Mot de passe">
          </div>

          <div class="input-group" :class="status.password_confirmation">
            <label for="password_confirmation">Confirmez votre mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" v-model="form.password_confirmation" placeholder="Mot de passe">
          </div>

          <div class="input-group input-group-lg">
            <button type="button" name="submit" v-on:click="submit">Valider</button>
          </div>

          {{form.name}}
          {{form.email}}
          {{form.password}}
          {{form.password_confirmation}}

        </div>

      </div>

    </div>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  export default {
    name: 'register',
    data () {
      return {
        form: {
          name: "",
          email: "",
          password: "",
          password_confirmation: ""
        },
        status: {
          name: "nosubmit",
          email: "nosubmit",
          password: "nosubmit",
          password_confirmation: "nosubmit"
        },
        errors: []
      }
    },
    methods: {
      submit () {
        console.log('La methode est appelée');


        // appel ajax en POST grace a Vue-Resource
        this.$http.post('/rest/register', {

          // les différentes valeurs a transmetre
          name: this.form.name,
          email: this.form.email,
          password: this.form.password,
          password_confirmation: this.form.password_confirmation

        }/*, {emulateJSON:true}*/).then((response) => {

          // s'execute si l'appel fonctionne bien
          console.log(response)

          this.status.errors = []
          for(let error in response.data){
            this.status.errors.push(response.data[error][0])
          }


        }, (response) => {

          // renvoie une erreur si l'appel a échoué
          //this.state.errors = []
          console.log('Erreur lors de la requète au serveur')
          //this.state.errors.push('Erreur lors de la requète.')

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
  #register{
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

          .errorsmessage{
            background-color: red;
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
