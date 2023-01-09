/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from "vue-router";
import axios from 'axios';
import VueAxios from 'vue-axios';
import { routes } from './routes';


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('product-card', require('./components/products/product-card').default);
Vue.component('product-list', require('./components/products/index').default);
Vue.component('product-create', require('./components/products/create').default);
Vue.component('product-edit', require('./components/products/edit').default);
Vue.component('sweatAlert', require('./components/layouts/sweatAlert').default);
Vue.component('navbar', require('./components/layouts/navbar.vue').default);

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
});
