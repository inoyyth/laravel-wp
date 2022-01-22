<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
    Route::get('/',  [ProductController::class, 'index'])->name('main');
    // Route::get('/data-table', ['uses' => 'TimeManagementController@index'])->name('data-table');
    // Route::get('/print', ['uses' => 'TimeManagementController@print'])->name('print');
});
