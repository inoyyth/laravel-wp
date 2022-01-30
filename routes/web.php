<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomepageController;

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

Route::group(['prefix' => '', 'as' => 'homepage.'], function () {
    Route::get('/',  [HomepageController::class, 'index'])->name('main');
});

Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
    Route::get('/',  [ProductController::class, 'index'])->name('main');
    // Route::get('/data-table', ['uses' => 'TimeManagementController@index'])->name('data-table');
    // Route::get('/print', ['uses' => 'TimeManagementController@print'])->name('print');
});

Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
    Route::get('/{slug}',  [ProductController::class, 'index'])->name('main');
    // Route::get('/data-table', ['uses' => 'TimeManagementController@index'])->name('data-table');
    // Route::get('/print', ['uses' => 'TimeManagementController@print'])->name('print');
});

