<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;


//home page
Route::get('/', [HomeController::class, 'index']);
//product detail
Route::get('/detail/{id}', [HomeController::class, 'detail']);
Route::get('/search', [HomeController::class, 'searchProduct']);


//devbanban.com 
//โปรแกรมที่มีขาย 40 ระบบ https://devbanban.com/?p=4425


//crud product
Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/list', [ProductController::class, 'list']);
Route::get('/product/adding', [ProductController::class, 'adding']);
Route::post('/product', [ProductController::class, 'create']);
Route::get('/product/{id}', [ProductController::class, 'edit']);
Route::put('/product/{id}', [ProductController::class, 'update']);
Route::delete('/product/remove/{id}', [ProductController::class, 'remove']);


//dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);

