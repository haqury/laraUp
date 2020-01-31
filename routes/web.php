<?php

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
use App\Service\RouteService;

Route::get('/', function () {
    return view('welcome');
});
//Route::group(['prefix' => App\Http\Middleware\LangMiddleware::getLocale()], function(){
//    Auth::routes();
//    Route::get('logout','Auth\LoginController@logout');
//    Route::get('/', 'HomeController@index')->name('home');
//});
Auth::routes();

Route::middleware('access:home,dasdasda,wadaws')->prefix('admin')->group(function () {
    Route::get('/users', 'HomeController@index')->name('home');
});

Route::get('/home', 'HomeController@index')->name('home');
