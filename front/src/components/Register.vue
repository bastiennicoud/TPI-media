<!-- Composant Rgister -->
<!-- Lorsque l'on souhaite s'enregistrer sur le site -->



<!-- template html du composant -->
<template>
  <div id="register">

    <div class="container">

      <div class="post-input-box">

        <h1>Inscription</h1>

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

          <div class="input-group" :class="status.name">
            <label for="username">Ce nom sera visible sur le site</label>
            <input id="username" type="text" name="username" v-on:keyup.enter="submit" v-model="form.name" placeholder="Nom d'utilisateur">
          </div>

          <div class="input-group" :class="status.email">
            <label for="email">Adresse e-mail valide</label>
            <input id="email" type="email" name="email" v-on:keyup.enter="submit" v-model="form.email" placeholder="E-mail">
          </div>

          <div class="input-group" :class="status.password">
            <label for="password">Mot de passe (6 caractères minimum)</label>
            <input id="password" type="password" name="password" v-on:keyup.enter="submit" v-model="form.password" placeholder="Mot de passe">
          </div>

          <div class="input-group" :class="status.password_confirmation">
            <label for="password_confirmation">Confirmez votre mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" v-on:keyup.enter="submit" v-model="form.password_confirmation" placeholder="Mot de passe">
          </div>

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
        fails: "nosubmit",
        messages: []
      }
    },
    methods: {
      submit () {
        // appel ajax en POST grace a Vue-Resource
        this.$http.post('/rest/register', {

          // les différentes valeurs a transmetre
          name: this.form.name,
          email: this.form.email,
          password: this.form.password,
          password_confirmation: this.form.password_confirmation

        }/*, {emulateJSON:true}*/).then((response) => {

          // s'execute si l'appel fonctionne bien

          this.messages = []

          if(response.body == true){
            this.fails = "false"
            this.messages.push('Votre inscription à bien été enregistrée.')
            this.$router.push('/login')
          } else {
            this.fails = "true"
            for(let error in response.data){
              this.messages.push(response.data[error][0])
            }
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
