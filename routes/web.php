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
Route::get('/', 'HomeController@index');
//Route::group(['prefix' => App\Http\Middleware\LangMiddleware::getLocale()], function(){
//    Auth::routes();
//    Route::get('logout','Auth\LoginController@logout');
//    Route::get('/', 'HomeController@index')->name('home');
//});
Auth::routes();

Route::/*middleware('access:admin')->*/prefix('admin')->group(function () {
    Route::get('/blocks', 'AdminController@blocks')->name('blocks');
    Route::post('/block/save', 'AdminController@saveBlock')->name('saveBlock');
    Route::get('/block/edit/{blockId}', 'AdminController@block')->name('editBlock');
});

Route::post('Controller/ajax', function (\Illuminate\Http\Request $request) {
//    $router = new \Illuminate\Routing\Route();
//    var_dump($request->input('call'));die;
//    $router->setAction(['uses' => $request->input('call')]);
//    return $router->run();

    $controllerAction = explode('@', $request->input('call'));
    $controllerName = '\App\Http\Controllers\\' . $controllerAction[0];
    $action = $controllerAction[1];
    $controller = new $controllerName;
    return $controller->$action($request);
});

Route::get('/home', 'HomeController@index')->name('home');
