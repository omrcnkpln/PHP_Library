require('./bootstrap');

import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
// import VueRouter from 'vue-router';              //"vue-router": "^4.1.6",
import VueRouter from 'vue-router';              //"vue-router": "^3.5.3",
import { routes } from './routes';
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VueSweetalert2);


Vue.component('product-card', require('./components/products/product-card').default);
Vue.component('product-list', require('./components/products/index').default);
Vue.component('product-create', require('./components/products/create').default);
Vue.component('product-edit', require('./components/products/edit').default);
Vue.component('sweatAlert', require('./components/layouts/sweatAlert').default);
Vue.component('route', require('./components/layouts/navbar.vue').default);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});


const app = new Vue({
    el: '#app',
    router: router,
    // render: h => h(router),
});
