<?php
// routes/web.php

use App\Http\Controllers\ApiIntegrationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;  // Added ProductController import

/*
|---------------------------------------------------------------------------|
| Web Routes                                                                |
|---------------------------------------------------------------------------|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [ProductController::class, 'index'])->name('products');
Route::post('/search', [ProductController::class, 'search']);
Route::get('/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
 
