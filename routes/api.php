<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\RoleController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\InvoiceController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\api\DailyIncomeController;
use App\Http\Controllers\api\DailyOutcomeController;
use App\Http\Controllers\api\InvoiceDetailController;
use App\Http\Controllers\api\MonthlyIncomeController;
use App\Http\Controllers\api\MonthlyOutcomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//api produk
Route::get('/product', [ProductController::class, 'index']);
Route::get('/products', [ProductController::class, 'getAll']);
Route::post('/product', [ProductController::class, 'store']);
Route::get('/product/{product}', [ProductController::class, 'show']);
Route::get('/seacrh-product', [ProductController::class, 'search']);
Route::put('/product/{product}', [ProductController::class, 'update']);
Route::delete('/product/{product}', [ProductController::class, 'destroy']);

// api customer 
Route::get('/customer', [CustomerController::class, 'index']);
Route::get('/customers', [CustomerController::class, 'getAll']);
Route::get('/customer/{customer}', [CustomerController::class, 'show']);
Route::get('/search-customer', [CustomerController::class, 'search']);
Route::post('/customer', [CustomerController::class, 'store']);
Route::put('/customer/{customer}', [CustomerController::class, 'update']);
Route::delete('/customer/{customer}', [CustomerController::class, 'destroy']);

// api daily outcome
Route::get('/daily-outcome', [DailyOutcomeController::class, 'index']);
Route::get('/daily-outcome/{dailyoutcome}', [DailyOutcomeController::class, 'show']);
Route::post('/daily-outcome', [DailyOutcomeController::class, 'store']);
Route::delete('/daily-outcome/{dailyoutcome}', [DailyOutcomeController::class, 'destroy']);
Route::put('/daily-outcome/{dailyoutcome}', [DailyOutcomeController::class, 'update']);

Route::get('/daily-outcome-history', [DailyOutcomeController::class, 'history']);
Route::get('/daily-outcome-detail', [DailyOutcomeController::class, 'detail']);

// api monthly outcome 
Route::get('/monthly-outcome', [MonthlyOutcomeController::class, 'index']);
Route::put('/monthly-outcome', [MonthlyOutcomeController::class, 'update']);

// api invoice
Route::get('/get-invoice-number', [InvoiceController::class, 'getInvoiceNumber']);
Route::get('/invoices-today', [InvoiceController::class, 'getToday']);
Route::post('/invoice', [InvoiceController::class, 'store']);
Route::put('/invoice-update', [InvoiceController::class, 'updateStatus']);

// api invoice detail
Route::get('/get-invoice-detail/{invoice}',[InvoiceDetailController::class, 'index']);
Route::delete('/get-invoice-detail/{invoiceDetail}',[InvoiceDetailController::class, 'destroy']);

// api daily income
Route::get('/daily-income',[DailyIncomeController::class, 'index']);
Route::get('/count-daily-income',[DailyIncomeController::class, 'countData']);
Route::put('/daily-income',[DailyIncomeController::class, 'update']);

// api monthly income
Route::get('/monthly-income', [MonthlyIncomeController::class, 'index']);
Route::put('/monthly-income', [MonthlyIncomeController::class, 'update']);

// api user
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{user}', [UserController::class, 'show']);
Route::put('/user/{user}', [UserController::class, 'update']);
Route::post('/user', [UserController::class, 'store']);
Route::delete('/user/{user}', [UserController::class, 'destroy']);

// api role
Route::get('/role', [RoleController::class, 'index']);
Route::post('/role', [RoleController::class, 'store']);
Route::delete('/role/{role}', [RoleController::class, 'delete']);

// api user rol
Route::get('/user-role', [UserController::class, 'getUsersRole']);
Route::get('/user-role/{user}', [UserController::class, 'getUserRole']);
Route::put('/user-role/{user}', [UserController::class, 'setUserRole']);



