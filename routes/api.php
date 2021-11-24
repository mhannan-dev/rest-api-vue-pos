<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
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

