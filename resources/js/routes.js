let login = require('./components/Auth/login.vue').default
let register = require('./components/Auth/register.vue').default
let forgotPass = require('./components/Auth/forgotPass.vue').default
//Authentication route start
let dashboard = require('./components/dashboard.vue').default
let logout = require('./components/Auth/logout.vue').default

// Register route array
export const routes = [
    { path: '/', component: login, name: '/' },
    { path: '/register', component: register, name: 'register' },
    { path: '/forgot-password', component: forgotPass, name: 'forgotPass' },

    { path: '/dashboard', component: dashboard, name: 'dashboard' },
    { path: '/logout', component: logout, name: 'logout' },
]
