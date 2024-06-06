<?php

use App\Http\Controllers\Cashier\CashierController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Managment\Category;
use App\Http\Controllers\Managment\MenuController;
use App\Http\Controllers\Managment\TableController;
use App\Http\Controllers\Managment\UserController;
use App\Http\Controllers\ManagmentController;
use App\Http\Controllers\Report\ReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function(){

    // Rutas de cashier
    Route::get('/cashier', [CashierController::class, 'index'])->name('cashier');
    Route::get('/cashier/getMenuByCategory/{category_id}', [CashierController::class, 'getMenuByCategory']);
    Route::get('/cashier/getTables', [CashierController::class, 'getTables'])->name('cashier.getTable');
    Route::post('/cashier/orderFood', [CashierController::class, 'orderFood']);
    Route::get('/cashier/getSaleDetailsByTable/{table_id}', [CashierController::class, 'getSaleDetailsByTable']);
    Route::post('/cashier/confirmOrderStatus', [CashierController::class, 'confirmOrderStatus']);
    Route::post('/cashier/deleteSetails', [CashierController::class, 'deleteSetails']);
    Route::post('cashier/paymentsave', [CashierController::class, 'paymentsave']);
    Route::get('/cashier/showReceipt/{SALE_ID}', [CashierController::class, 'showReceipt']);
    
    // routes para report
    Route::get('/report',[ReportController::class,'index']);
});
Route::middleware(['auth','VerifyAdmin'])->group(function(){

    Route::get('/managment', [ManagmentController::class, 'index'])->name('managment');
   
    
    // dentro de managment
    Route::resource('managment/category',Category::class);
    Route::resource('managment/menu',MenuController::class);
    Route::resource('managment/table',TableController::class);
    Route::resource('managment/user',UserController::class);

});