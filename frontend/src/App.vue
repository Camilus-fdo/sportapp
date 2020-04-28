<template>
  <div id="app">
    <router-view></router-view>
  </div>

</template>

<script>
export default {
  name: 'app',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  }
}
</script>

<style>
@import "./assets/css/login.css";
 @import "./assets/css/main.css";
 @import "./assets/css/scoreboard.css";
</style>
