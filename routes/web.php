<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DailyIncomeController;
use App\Http\Controllers\DailyOutcomeController;
use App\Http\Controllers\MonthlyIncomeController;
use App\Http\Controllers\MonthlyOutcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/master/customer', [CustomerController::class, 'index'])->name('customer');
Route::get('/master/product', [ProductController::class, 'index'])->name('product');

Route::get('/outcome/daily', [DailyOutcomeController::class, 'index'])->name('daily-outcome');
Route::get('/outcome/daily-detail', [DailyOutcomeController::class, 'detail'])->name('daily-outcome-detail');
Route::get('/outcome/monthly', [MonthlyOutcomeController::class, 'index'])->name('monthly-outcome');

Route::get('/income/invoice', [InvoiceController::class, 'index'])->name('income-invoice');

Route::get('/income/daily', [DailyIncomeController::class, 'index'])->name('daily-income');

Route::get('/income/monthly', [MonthlyIncomeController::class, 'index'])->name('monthly-income');

Route::get('/user/data',[UserController::class, 'index'])->name('user');
Route::get('/user/change-password',[UserController::class, 'changePassword'])->name('change-password');
Route::put('/user/change-password',[UserController::class, 'setPassword']);

Route::get('/user-role', [UserController::class, 'setRole'])->name('user-role');

Route::get('/role', [RoleController::class, 'index'])->name('role');