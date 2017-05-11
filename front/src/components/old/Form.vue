<template>
  <div class="form">
    <h1>{{ msg }}</h1>
    <input type="text" name="title" v-model="title" placeholder="Votre titre">
    <input type="text" name="slug" v-model="slug" placeholder="Votre slug">
    <input type="text" name="content" v-model="content" placeholder="Votre contenu">
    <p>{{ title }}</p>
    <p>{{ slug }}</p>
    <p>{{ content }}</p>
    <button type="button" name="button" @click="api">Envoyer</button>
  </div>
</template>

<script>

export default {
  name: 'form',
  data () {
    return {
      msg: 'Teston notre API REST avec un formulaire',
      title: '',
      slug: '',
      content: '',
    }
  },
  methods: {
    api () {
      //console.log(this.message)

      // appel ajax en POST grace a Vue-Resource
      this.$http.post('/api/post', {

        title: this.title,
        slug: this.slug,
        content: this.content

      }, {emulateJSON:true}).then((response) => {

        // s'execute si l'appel fonctionne bien
        //console.log(response)

        console.log(response)
        this.msg = response.data



      }, (response) => {

        // renvoie une erreur si l'appel a échoué
        console.log(response)
        console.log('Erreur lors de la requète au serveur')
        this.msg = 'Aie, l\'API n\'a pas répondu.'

      })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>
