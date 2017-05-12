// ce fichier permet de définir le store de mon application vue.js
// le store est un objet global qui va contenir différentes propriétés
// et variables qui vont etre accesible par tous les composants de l'application

import Vuex from 'vuex'

// je crée le nouveau store
export default new Vuex.Store({
  // definition des différentes propriétés du store
  state: {
    user: {
      connected: false,
      name: '',
      role: 3,
      photo: '/ressources/profilephotos/default.png'
    }
  },
  // definition des mutations
  // les mutations vont permettre de modifier l'etat du store
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
    }
  },
  // definition des getters
  // les getters von permetre d'obtenir certaines proprietes du state facilement
  getters: {
    userConnected: state => state.user.connected,
    userName: state => state.user.name,
    userRole: state => state.user.role,
    userPhoto: state => state.user.photo
  },
  actions: {}
})
