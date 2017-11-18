<template>
  <div id="app">
    <h1>{{ msg }}</h1>
    <p>{{ sass }}</p>
  </div>
</template>

<script>
export default {
  name: "app",
  data() {
    return {
      msg: "Welcome Webpack is working",
      sass: "Sass is working"
    };
  }
};
</script>

<style lang="scss">
@import "~styles/_vars.scss";
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: $green;
  margin-top: 60px;
}

h1,
h2 {
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
