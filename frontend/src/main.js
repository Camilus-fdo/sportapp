import Vue from 'vue'
import App from './App.vue'
import Router from './router.js';
import store from "./store.js";
import axios from 'axios'
import VueAxios from 'vue-axios'
import swal from 'sweetalert'
import DataTable from 'v-data-table';

Vue.use(VueAxios, axios)
Vue.use(DataTable)

new Vue({
  el: '#app',
  store,
  render: h => h(App),
  router: Router
})
