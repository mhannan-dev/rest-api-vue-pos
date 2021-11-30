<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PosController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\SupplierController;
Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->name('me');
});
Route::apiResource('/employee', EmployeeController::class);
Route::apiResource('/supplier', SupplierController::class);
Route::apiResource('/category', CategoryController::class);
Route::apiResource('/product', ProductController::class);
Route::apiResource('/customer', CustomerController::class);
Route::post('/product-stock-update/{id}',[ProductController::class, 'updateStock']);
Route::apiResource('/expense', ExpenseController::class);
Route::post('/salary/paid/{id}',[SalaryController::class, 'salaryPaid']);
Route::get('/salary',[SalaryController::class, 'allSalary']);
Route::get('/salary/view/{id}',[SalaryController::class, 'salaryView']);
Route::get('/salary/edit/{id}',[SalaryController::class, 'salaryEdit']);
Route::post('/salary/update/{id}',[SalaryController::class, 'salaryUpdate']);
Route::get('/gettting-products/{id}',[PosController::class, 'subProducts'])->name('getting.products');
//Cart
Route::get('/add-to-cart/{id}',[CartController::class, 'addToCart'])->name('addToCart.product');
Route::get('/cart-product/',[CartController::class, 'cartProducts'])->name('cart.product');
Route::get('/remove-cart-product/{id}',[CartController::class, 'removeCart']);
Route::get('/cart-increment/{id}',[CartController::class, 'incrementCart']);
Route::get('/cart-decrement/{id}',[CartController::class, 'decrementCart']);
Route::get('/vat',[CartController::class, 'vatAmount']);
//Order placing
Route::post('/place-order',[PosController::class, 'placeOrder']);
Route::get('/today-orders',[OrderController::class, 'todayOrders']);
Route::get('/order-details/{id}',[OrderController::class, 'orderDetails']);
Route::get('/order-order_details/{id}',[OrderController::class, 'orderDetailAll']);
Route::post('/search-order/',[OrderController::class, 'searchOrder']);
//Admin dashboard Route
Route::get('/today-total-sell',[OrderController::class, 'todayTotal']);
Route::get('/today-received-amount',[OrderController::class, 'todayRcvdAmount']);
Route::get('/today-due-amount',[OrderController::class, 'todayDueAmount']);
Route::get('/today-expense',[OrderController::class, 'todayExpAmount']);
Route::get('/stockout',[OrderController::class, 'stockOut']);
