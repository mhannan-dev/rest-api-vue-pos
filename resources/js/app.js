/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap')
import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
// Helpers
import User from './Helpers/User'
window.User = User
import Notifications from './Helpers/Notifications'
window.Notifications = Notifications
//Sweet Alert
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
window.Toast = Toast;
//Another alert message
//Message toastr
import 'cxlt-vue2-toastr/dist/css/cxlt-vue2-toastr.css';
import CxltToastr from 'cxlt-vue2-toastr'
var toastrConfigs = {
    position: 'top right',
    showDuration: 2000
}
Vue.use(CxltToastr, toastrConfigs)
Vue.use(CxltToastr)
//Reload
window.Reload = new Vue();
// Routes
import { routes } from './routes'
const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    el: '#app',
    router
})
