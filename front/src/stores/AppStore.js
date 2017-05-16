// ce fichier permet de définir le store de mon application vue.js
// le store est un objet global qui va contenir différentes propriétés
// qui vont etre accesible par tous les composants de l'application

// importe VueX, librairie qui permet la gestion du store global
import Vuex from 'vuex'

// je crée le nouveau store
export default new Vuex.Store({
  // definition des différentes propriétés du store
  state: {
    user: {
      connected: false,
      name: '',
      role: 3,
      photo: '/ressources/profilephotos/default.png',
      notification: 0
    }
  },
  // definition des mutations
  // les mutations vont permettre de modifier l'etat du store
  // lorsque l'on voudras modifier le store, il suffira d'appeler la mutation qui effectue l'actionn que l'on recherche
  // et eventuellement d'y passer les paramètres nésaisaires
  mutations: {
    USER_CONNECT: (state) => {
      state.user.connected = true
    },
    USER_DISCONNECT: (state) => {
      state.user.connected = false
    },
    USER_SETNAME: (state, name) => {
      state.user.name = name
    },
    USER_SETPHOTO: (state, url) => {
      state.user.photo = url
    },
    USER_SETROLE: (state, role) => {
      state.user.role = role
    },
    USER_SETNOTIFICATION: (state, notification) => {
      state.user.notification = notification
    },
    USER_CLEANNOTIFICATION: (state) => {
      state.user.notification = 0
    }
  },
  // definition des getters
  // les getters von permetre d'obtenir certaines proprietes du state facilement
  // l'objectif des getters et de ne jamais accéder directement aux probriétés du store depuis l'extérieur
  // depuis nimporte quel composant
  getters: {
    userConnected: state => state.user.connected,
    userName: state => state.user.name,
    userRole: state => state.user.role,
    userPhoto: state => state.user.photo,
    userNotification: state => state.user.notification
  },
  // les actions permettent d'utiliser plus facilement les mutations
  // je n'en utilise pas dans mon cas
  actions: {}
})
