/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'vuex';
import VueRouter from "vue-router";
import Routes from './routes';

Vue.use(VueRouter);
Vue.use(Vuex);

const router = new VueRouter({
    router,
    mode:'history'

})
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});
