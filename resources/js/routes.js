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
//Category
let categories = require('./components/Category/categories.vue').default
let categoryAdd = require('./components/Category/categoryAdd.vue').default
let categoryEdit  = require('./components/Category/categoryEdit.vue').default
//Product
let products = require('./components/Product/products.vue').default
let productAdd = require('./components/Product/productAdd.vue').default
let productEdit  = require('./components/Product/productEdit.vue').default
//Stock
let stock = require('./components/Product/stock.vue').default
let updateStock = require('./components/Product/editStock.vue').default
//Expenses
let expenses = require('./components/Expense/expenses').default
let expenseAdd = require('./components/Expense/expenseAdd.vue').default
let expenseEdit  = require('./components/Expense/expenseEdit.vue').default
//Salary
let employeeSheet  = require('./components/Salary/all_employees.vue').default
let allSalary  = require('./components/Salary/index.vue').default
let paySalary  = require('./components/Salary/create.vue').default
let viewSalary  = require('./components/Salary/view.vue').default
let editSalary  = require('./components/Salary/edit.vue').default

//Customers
let customers  = require('./components/Customer/all_customer.vue').default
let customerAdd  = require('./components/Customer/customerAdd.vue').default
let customerEdit  = require('./components/Customer/customerEdit.vue').default
//POS
let pos  = require('./components/POS/pos.vue').default
//Orders
let todayOrders  = require('./components/Order/todayOrders.vue').default
let viewOrder  = require('./components/Order/todayOrderDetail.vue').default
let searchBydate  = require('./components/Order/searchBydate.vue').default


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
    //Supplier
    { path: '/suppliers', component: suppliers, name: 'suppliers'},
    { path: '/supplier-add', component: supplierAdd, name: 'supplierAdd'},
    { path: '/supplier-edit/:id', component: supplierEdit, name: 'supplierEdit'},
    // Category
    { path: '/categories', component: categories, name: 'categories'},
    { path: '/category-add', component: categoryAdd, name: 'categoryAdd'},
    { path: '/category-edit/:id', component: categoryEdit, name: 'categoryEdit'},
    // Product
    { path: '/products', component: products, name: 'products'},
    { path: '/product-add', component: productAdd, name: 'productAdd'},
    { path: '/product-edit/:id', component: productEdit, name: 'productEdit'},
    //Stock
    { path: '/stock', component: stock, name: 'stock'},
    { path: '/update-stock/:id', component: updateStock, name: 'updateStock'},
    // Expense
    { path: '/expenses', component: expenses, name: 'expenses'},
    { path: '/expense-add', component: expenseAdd, name: 'expenseAdd'},
    { path: '/expense-edit/:id', component: expenseEdit, name: 'expenseEdit'},
    // Salaries
    { path: '/employee-salary-list/', component: employeeSheet, name: 'employeeSheet'},
    { path: '/pay-salary/:id', component: paySalary, name: 'paySalary'},
    { path: '/salary', component: allSalary, name: 'allSalary'},
    { path: '/view-salary/:id', component: viewSalary, name: 'view-salary'},
    { path: '/edit-salary/:id', component: editSalary, name: 'edit-salary'},
    //Customers
    { path: '/customers/', component: customers, name: 'customers'},
    { path: '/customer-add/', component: customerAdd, name: 'customerAdd'},
    { path: '/customer-edit/', component: customerEdit, name: 'customerEdit'},
    //POS
    { path: '/pos', component: pos, name: 'pos'},
    //Order
    { path: '/today-orders', component: todayOrders, name: 'todayOrders'},
    { path: '/view-order/:id', component: viewOrder, name: 'viewOrder'},
    { path: '/date-by-search', component: searchBydate, name: 'searchBydate'},
]
