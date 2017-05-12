<!-- Composant NavMenu -->
<!-- Représente la navigation de mon site -->



<!-- template html du composant -->
<template>
  <div id="navmenu">

    <div class="container">

      <div id="navlinks">
        <router-link class="space" :to="{name: 'Home'}">Acceuil</router-link>
        <router-link class="space" :to="{name: 'LastPosts'}">Derniers posts</router-link>
      </div>

      <div id="menu">

        <!-- Image du profile affichée dans la navigation si la personne est connectée -->
        <router-link v-if="userConnected" id="profilename" :to="{name: 'MyProfile'}">{{userName}}</router-link>
        <img  v-if="userConnected" id="profile" v-bind:src="userPhoto" alt="Photo de profile lego">

        <!-- Menu burger -->
        <div id="burger" v-on:click="toggle" :class="{opened: open, closed: !open}">
          <span></span>
          <svg x="0" y="0" width="50px" height="50px" viewBox="0 0 50 50">
            <circle cx="25" cy="25" r="24"></circle>
          </svg>
        </div>

      </div>

    </div>

    <!-- La navigation optimisée mobiles (qui apparait lors du click sur le burger) -->
    <div id="navmobile" :class="{opened: open, closed: !open}">
      <div class="container-nav">
        <ul>
          <li class="onlysmall"><router-link :to="{name: 'Home'}" v-on:click.native="toggle">Acceuil</router-link></li>
          <li class="onlysmall"><router-link :to="{name: 'LastPosts'}" v-on:click.native="toggle">Derniers posts</router-link></li>
          <li v-if="!userConnected"><router-link :to="{name: 'Login'}" v-on:click.native="toggle">Connexion</router-link></li>
          <li v-if="!userConnected"><router-link :to="{name: 'Register'}" v-on:click.native="toggle">Inscrivez-vous</router-link></li>
          <li v-if="userConnected && userRole == 2"><router-link :to="{name: 'NewPost'}" v-on:click.native="toggle">Nouveau post</router-link></li>
          <li v-if="userConnected && userRole == 2"><router-link :to="{name: 'MyPosts'}" v-on:click.native="toggle">Mes posts</router-link></li>
          <li v-if="userConnected"><router-link :to="{name: 'MyProfile'}" v-on:click.native="toggle">Mon Profile</router-link></li>
          <li v-if="userConnected"><a v-on:click.prevent="disconnect">Deconnexion</a></li>
        </ul>
      </div>
    </div>

  </div>
</template>



<!-- script contient tout le script lié au composant -->
<script>
  export default {
    name: 'navMenu',
    data () {
      return {
        open: false
      }
    },
    methods: {
      // cette methode me permer de definir si le menu est ouvert ou fermé
      toggle () {
        if (this.open === false){
          this.open = true
        } else {
          this.open = false
        }
      },
      // cette methode est appelée lorsque l'on clique sur le bouton de déconnexio
      disconnect () {
        this.$http.post('/rest/logout').then((response) => {

          // si un utilisateur a bien été deconnecté
          if(response.body == true){
            // on va modifier l'etat global de vue js pour y supprimer les infos liées a l'utilisateur
            // j'utilise les mutations pour effectuer les changements de state
            // les muttations sont définiees dans le stores/AppStore.js
            this.$store.commit('USER_DISCONNECT')
            this.$store.commit('USER_SETNAME', '')
            this.$store.commit('USER_SETPHOTO', '')
            this.$store.commit('USER_SETROLE', '')

            // je redirige l'utilisateur a la page d'acceuil
            this.$router.push('/')
            // methode toggle pour fermer le menu
            this.toggle()
          } else {
            // si la deconnexion n'a pas fonctionné
            this.$router.push('/')
            console.log("Vous n'avez pas pu etre déconnecté")
          }


        }, (response) => {

          console.log('Erreur lors de la requète au serveur')

        })
      }
    },
    computed: {
      // les proprietées suivantes sont issues du state global de l'application
      // je vais chercher les valeurs avec les getters dans le $store
      // ses getters sont définis dans le fichier AppStore.js
      userConnected () {
        return this.$store.getters.userConnected
      },
      userName () {
        return this.$store.getters.userName
      },
      userPhoto () {
        return this.$store.getters.userPhoto
      },
      userRole () {
        return this.$store.getters.userRole
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
  #navmenu{
    box-sizing: border-box;
    height: 70px;
    background-color: $grisClair;

    .container{
      padding: 10px;
      display: flex;
      justify-content: flex-end;

      #navlinks{
        display: none;

        @media(min-width: $tablet){
          display: block;
        }

        .space{
          margin-right: $defaultMg;
        }

        a:hover{
          color: black;
        }
      }

      // les 2 icones du menu (photo de profile et burger menu)
      #menu{
        display: flex;
        justify-content: flex-end;

        #profilename{
          margin: auto 10px;
        }

        #profile{
          height: 50px;
          width: 50px;
          margin-right: 10px;

          border-radius: 50px;
        }

        #burger{
          position: relative;
          height: 50px;
          width: 50px;

          transition: transform $long;

          // style pour créer 3 traits dans le burger
          span{
            position: absolute;
            top: 50%;
            left: 50%;

            display: block;
            width: 22px;
            height: 2px;

            background-color: $grisFonce;
            transform: translateX(-50%) translateY(-50%);
            transition: background $long;

            // me permet de stylyser 2 pseudo elements de la span
            &::before, &::after{
              content: '';

              position: absolute;
              top: 0;
              left: 0;

              display: block;
              width: 22px;
              height: 2px;

              background-color: $grisFonce;

              transform-origin: 50% 50%;
              transition: transform $long;
            }

            &::before{
              transform: translateY(-6px);
            }

            &::after{
              transform: translateY(6px);
            }
          }//span

          &:hover{

            span{
              &::before{
                transform: translateY(-8px);
              }
              &::after{
                transform: translateY(8px);
              }
            }
          }//:hover

          svg{
            fill: $grisClair;
            stroke-width: 1px;
            stroke: $grisFonce;
          }

          // quant on clique sur le burger
          &.opened{
            transform: rotate(180deg);

            span{
              background: transparent;

              &::before{
                transform: translateY(0) rotate(45deg);
              }
              &::after{
                transform: translateY(0) rotate(-45deg);
              }
            }
          }//.opened
        }//#burger
      }//#menu

      @media(min-width: $tablet){
        justify-content: space-between;
        align-items: center;
      }

      @media(min-width: $large){
        width: 960px;
        margin: 0px auto;
      }
    }


    // la navigation qui apparais sur mobile
    #navmobile{
      position: relative;
      top: 0px;

      z-index: 900;

      padding: 10px;
      background-color: rgba(48, 48, 48, 0.7);

      transform: translateX(100%);

      transition: transform $long cubic-bezier(.26,.67,.67,.97);

      .container-nav{
        ul{
          padding: 0px;
          margin: 0px;

          // elements de la liste
          li{
            list-style: none;
            text-align: right;

            transform: translateX(200px);

            transition: transform $long;

            // declage de l'animation pour chaques éléments
            &:nth-child(2){
              transition-delay: 0.05s;
            }
            &:nth-child(3){
              transition-delay: 0.1s;
            }
            &:nth-child(4){
              transition-delay: 0.15s;
            }
            &:nth-child(5){
              transition-delay: 0.2s;
            }
            &:nth-child(6){
              transition-delay: 0.25s;
            }
            &:nth-child(7){
              transition-delay: 0.3s;
            }
            &:nth-child(8){
              transition-delay: 0.35s;
            }

            // Les liens
            a{
              color: $grisClair;

              &:hover{
                color: $blancFond;
              }
            }//a
          }//li

          // masque certains lien sur les grands ecrans
          .onlysmall{
            @media(min-width: $tablet){
              display: none;
            }
          }
        }//ul

        @media(min-width: $large){
          width: 960px;
          margin: 0px auto;
        }
      }

      // classe qui fais apparaitre la navigation
      &.opened{
        transform: translateX(0px);
        ul{
          li{
            transform: translateX(0px);
          }
        }
      }
    }

    a{
      font-family: 'Futura-medium';
      font-size: 24px;
      text-decoration: none;
      color: $grisFonce;
    }
  }
</style>
