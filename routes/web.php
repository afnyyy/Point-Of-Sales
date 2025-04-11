<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BelajarController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('belajar', [BelajarController::class, 'index']);
Route::get('tambah', [BelajarController::class, 'tambah']);
// Route::get('kurang', [BelajarController::class, 'kurang']);
// Route::get('bagi', [BelajarController::class, 'bagi']);
// Route::get('kali', [BelajarController::class, 'kali']);

Route::post('action-tambah', [BelajarController::class, 'actionTambah']);
Route::get('login', [LoginController::class,'login']);
Route::post('action-login', [LoginController::class, 'actionLogin']);

Route::resource('dashboard', DashboardController::class);
Route::resource('categories', CategoriesController::class);
Route::resource('products',ProductsController::class);
Route::resource('pos', TransactionController::class);
Route::resource('users', UsersController::class);

Route::get('get-product/{id}', [TransactionController::class, 'getProduct']);
Route::get('logout', [LoginController::class, 'logout']);
Route::get('print/{id}', [TransactionController::class, 'print'])->name('print');
