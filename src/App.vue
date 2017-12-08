<template>
  <div id="home">
    <h1>{{ msg }}</h1>
    <p>{{ sass }}</p>
  </div>
</template>

<script>
export default {
  props: ["userData"],
  name: "home",
  data() {
    return {
      msg: " If these letters are green Webpack is working",
      sass: "and Sass is working"
    };
  }
};
</script>

<style lang="scss">
@import "./styles/_globals.scss";

#home {
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
