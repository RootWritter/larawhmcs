<?php

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

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index']);
Route::get('/new-order', [\App\Http\Controllers\IndexController::class, 'neworder']);
Route::get('/sign-in', [\App\Http\Controllers\AuthController::class, 'login']);
Route::get('/sign-up', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/sign-in', [\App\Http\Controllers\AuthController::class, 'doLogin']);
Route::post('/sign-up', [\App\Http\Controllers\AuthController::class, 'doRegister']);

Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function () {
    Route::post('/get-product', [\App\Http\Controllers\AjaxController::class, 'getproductDetail']);
});
