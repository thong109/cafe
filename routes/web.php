<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

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
Route::resource('/admin', AdminController::class);
Route::post('/admin-acc', [AdminController::class, 'makeAcc']);
// Route::get();
Route::get('/admin-ress', [AdminController::class, 'resgiter']);
Route::get('/category', [CategoryController::class, 'category']);
Route::get('/table', [TableController::class, 'table']);
Route::post('/admin-register', [AdminController::class, 'adminRegister']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);
Route::get('/statistical', [AdminController::class, 'statistical']);
Route::get('/detail-table/{id}', [TableController::class, 'detailTable']);
Route::post('/add-table', [TableController::class, 'addTable']);
Route::post('/creat-table', [TableController::class, 'creatTable']);
Route::post('/table-page', [TableController::class, 'tablePage']);
Route::post('/add-category', [CategoryController::class, 'addCategory']);

