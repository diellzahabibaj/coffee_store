<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('isAdmin')->get('/admin', function (Request $request) {
    return $request->user();
});

/*Route::get('user',['middleware'=>'auth:api', function(){
    return view('user');
}]);
Route::get('admin',['middleware'=>'isAdmin', function(){
    return view('admin');
}]);*/



Route::apiResource('customers', 'Api\\CustomersController');
Route::apiResource('products', 'Api\\Products')->middleware('isAdmin');
Route::apiResource('orders', 'Api\\OrdersController')->middleware('isAdmin');

/*
Route::get('customers', 'Api\\CustomersController@index')->name('customers.index');
Route::get('customers/create', 'Api\\CustomersController@create')->name('customers.create');
Route::post('customers', 'Api\\CustomersController@store')->name('customers.store');
Route::get('customers/{customer}', 'Api\\CustomersController@show')->name('customers.show')->middleware('isAdmin');
Route::delete('customers/{customer}', 'Api\\CustomersController@destroy')->name('customers.destroy')->middleware('isAdmin');


Route::get('orders', 'Api\\OrdersController@index')->name('orders.index');
Route::get('orders/create', 'Api\\OrdersController@create')->name('orders.create');
Route::post('orders', 'Api\\OrdersController@store')->name('orders.store');
Route::get('orders/{order}', 'Api\\OrdersController@show')->name('orders.show')->middleware('isAdmin');
Route::delete('orders/{order}', 'Api\\OrdersController@destroy')->name('orders.destroy')->middleware('isAdmin');
*/



//Route::post('products','Products@store');

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {
   
    Route::post('register', 'Api\RegistrationController@register');
    Route::post('login', 'Api\AuthController@login');
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('me', 'Api\AuthController@me');

    

    Route::get('email/verify/{token}', 'Api\VerificationController@verify')->name('verification.verify');
    
});