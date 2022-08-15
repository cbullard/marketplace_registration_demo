import Vue from "vue";
import Vuex from 'vuex'
import 'es6-promise/auto'
import store from '../../store/index';
// import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

Vue.use(Vuex)
// Vue.component('font-awesome-icon', FontAwesomeIcon)
import sellerRegistration from "./seller";

const app = new Vue({
  el: '#app',
  store: store,
  components: { sellerRegistration }
})