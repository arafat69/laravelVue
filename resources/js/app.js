/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
// import Vue from 'vue';

require('./bootstrap');

window.Vue = require('vue').default;

// vue router import

import VueRouter from 'vue-router';

Vue.use(VueRouter);


import {routes} from './routers';

const router = new VueRouter({
  routes, // short for `routes: routes`
  mode:'hash',
});

// v form support
import Form from 'vform';
window.Form = Form;

// Sweetalert 2 support
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });
  window.Toast = Toast;

// vuex support
import Vuex from 'vuex'
Vue.use(Vuex)
import storeInfo from './store';
const store = new Vuex.Store(
   storeInfo
);

// CKEditor support
import CKEditor from '@ckeditor/ckeditor5-vue2';
Vue.use( CKEditor );

// support google charts
import VueGoogleCharts from 'vue-google-charts'
Vue.use(VueGoogleCharts)

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin-masterpage', require('./components/adminmaster.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router,
    store
});
