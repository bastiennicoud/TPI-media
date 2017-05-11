<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
    <button type="button" name="button" @click="api">Test API</button>



  </div>
</template>

<script>
import Dropzone from 'vue2-dropzone'

export default {
  name: 'hello',
  data () {
    return {
      msg: 'Appuyons sur le bouton pour tester l\'API rest'
    }
  },
  methods: {
    api () {
      //console.log(this.message)

      // appel ajax en POST grace a Vue-Resource
      this.$http.get('/api/test', {


      }, {emulateJSON:true}).then((response) => {

        // s'execute si l'appel fonctionne bien
        //console.log(response)

        console.log(response)
        this.msg = response.data



      }, (response) => {

        // renvoie une erreur si l'appel a échoué
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
