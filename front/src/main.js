// -----------------------------------------------------------------------------
// main.js
// Ce fichier représente le point d'entrée de l'application Vue.js
// C'est ici que j'importe les différentes librairies, que je déclare les routes
// ainsi que je déclare l'application
// -----------------------------------------------------------------------------

// Chargement des différentes librairiess
import Vue from 'vue'
import VueResource from 'vue-resource'
import VueClip from 'vue-clip'
import Vuex from 'vuex'
import VueRouter from 'vue-router'

// j'indique a vue de charger les librairies préalablement chargées
Vue.use(VueResource)
Vue.use(VueClip)
Vue.use(Vuex)
Vue.use(VueRouter)

// point de configuration
Vue.config.productionTip = false



// Nouvelle instance de VueRouteur, ici je déclare toutes les routes de mon application
const router = new VueRouter({
  mode: 'history',
  // declaration des routes
  routes: [{

    // page d'acceuil
    path: '/',
    name: 'Home',
    component: require('./components/Home.vue')

  },{

    // Affiche les derniers articles (date d'ajout)
    path: '/lastposts',
    name: 'LastPosts',
    component: resolve => require(['./components/LastPosts.vue'], resolve)

  },{

    // Affiche les derniers articles (date d'ajout)
    path: '/pastposts',
    name: 'PastPosts',
    component: resolve => require(['./components/PastPosts.vue'], resolve)

  },{

    // Page consulter un article
    path: '/post/:slug',
    name: 'Post',
    component: resolve => require(['./components/PostComplete.vue'], resolve),
    props: true

  },{

    // Page pour ajouter un post
    path: '/newpost',
    name: 'NewPost',
    component: resolve => require(['./components/NewPost.vue'], resolve)

  },{

    // Page qui liste ses propres articles
    path: '/myposts',
    name: 'MyPosts',
    component: resolve => require(['./components/MyPosts.vue'], resolve)

  },{

    // Page pour la modification d'un article
    path: '/editpost/:postId',
    name: 'EditPost',
    component: resolve => require(['./components/EditPost.vue'], resolve),
    props: true

  },{

    // page d'inscription
    path: '/register',
    name: 'Register',
    component: resolve => require(['./components/Register.vue'], resolve)

  },{

    // page de login
    path: '/login',
    name: 'Login',
    component: resolve => require(['./components/Login.vue'], resolve)

  },{

    // page qui affiche son profile
    path: '/myprofile',
    name: 'MyProfile',
    component: resolve => require(['./components/MyProfile.vue'], resolve)

  },{

    // page qui affiche son profile
    path: '/addvideo',
    name: 'Videos',
    component: resolve => require(['./components/AddVideo.vue'], resolve)

  },{

    // route appelée si l'url appelé n'existe pas
    path: '*',
    redirect: '/'

  }]
})



// ICI je déclare l'application Vue.js, je lui indique sur quel element elle dois se gréfer,
// je lui passe le routeur, et je lui dis de rendre la vue en chargeant le composant principal App.vue
new Vue({
  el: '#app',
  router,
  render: h => h(require('./App.vue'))
})
