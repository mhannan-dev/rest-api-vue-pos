let login = require('./components/login.vue').default
let register = require('./components/register.vue').default
let forgetPass = require('./components/forgetPass.vue').default

// Register route array
export const routes = [
    { path: '/', component: login, name: '/' },
    { path: '/register', component: register, name: 'register' },
    { path: '/forget-password', component: forgetPass, name: 'forgetPass' }
]
