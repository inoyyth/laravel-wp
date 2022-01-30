<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => '', 'as' => 'homepage.'], function () {
    Route::get('/', [HomepageController::class, 'index'])->name('main');
});

Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('main');
});

Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
    Route::get('/{slug}', [ProductController::class, 'index'])->name('main');
});

Route::get('login/', [UserController::class, 'index'])->name('login');
Route::post('login/', [UserController::class, 'userValidate'])->name('user_validation');
Route::get('logout/', [UserController::class, 'userLogout'])->name('user_logout');

Route::group(['prefix' => 'customer', 'as' => 'customer.', 'middleware' => ['ensure.customer']], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('main');
});

