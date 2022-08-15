/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// Require Vue
window.Vue = require('vue').default;

import App from './App.vue';

new Vue({
    render: h =>(App)
}).$mount('#app');
