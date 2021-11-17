let login = require('./components/Auth/login.vue').default
let register = require('./components/Auth/register.vue').default
let forgotPass = require('./components/Auth/forgotPass.vue').default
//Authentication route start
let dashboard = require('./components/dashboard.vue').default
let logout = require('./components/Auth/logout.vue').default

let employees = require('./components/Emp/employees.vue').default
let employeeAdd = require('./components/Emp/employeeAdd.vue').default
let employeeEdit = require('./components/Emp/employeeEdit.vue').default

let suppliers = require('./components/Supplier/suppliers.vue').default
let supplierAdd = require('./components/Supplier/supplierAdd.vue').default
let supplierEdit  = require('./components/Supplier/supplierEdit.vue').default

// Register route array
export const routes = [
    { path: '/', component: login, name: '/' },
    { path: '/register', component: register, name: 'register' },
    { path: '/forgot-password', component: forgotPass, name: 'forgotPass' },

    { path: '/dashboard', component: dashboard, name: 'dashboard' },
    { path: '/logout', component: logout, name: 'logout' },

    { path: '/employees', component: employees, name: 'employees' },
    { path: '/employee-add', component: employeeAdd, name: 'employeeAdd' },
    { path: '/employee-edit/:id', component: employeeEdit, name: 'employeeEdit' },

    { path: '/suppliers', component: suppliers, name: 'suppliers'},
    { path: '/supplier-add', component: supplierAdd, name: 'supplierAdd'},
    { path: '/supplier-edit', component: supplierEdit, name: 'supplierEdit'},

]
