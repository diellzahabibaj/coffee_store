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

/*Route::get('/', function () {
    return view('/welcome');
});*/

Route::view('/', 'welcome');

/*Route::get('/products','Products@index');
Route::post('/products','Products@store');
Route::get('/products/create ','Products@create');
Route::get('/products/{product}','Products@show');
Route::delete('/products/{product}','Products@destroy');*/
Route::resource('products','Products');
Route::resource('customers','CustomersController');

/*Route::get('orders', 'OrdersController@index')->name('orders.index');
Route::get('orders/create', 'OrdersController@create')->name('orders.create');
Route::post('orders', 'OrdersController@store')->name('orders.store');
Route::get('orders/{order}', 'OrdersController@show')->name('orders.show')->middleware('isAdmin');
Route::delete('orders/{order}', 'OrdersController@destroy')->name('orders.destroy')->middleware('isAdmin');*/

Route::resource('orders', 'OrdersController');

//Route::post('/products', 'Products@store');
/*Route::resource('/api/products','Api\Products');
Route::resource('/api/customers','Api\CustomersController');
Route::resource('/api/orders', 'Api\OrdersController');*/

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes(['verify'=>true]);

/*Route::get('/home', 'HomeController@index')->name('home');
*/
/*Route::group(['middleware'=> ['auth']], function (){
    Route::get('/user', 'UsersController@user')->name('user');

    Route::group(['middleware'=> ['admin']], function (){
       Route::get('/admin', 'UsersController@admin')->name('admin');
  });
});

//Route::get('/home', 'HomeController@index')->name('home');
 



//Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);*/

Route::get('user',['middleware'=>'auth', function(){
    return view('user');
}]);
Route::get('admin',['middleware'=>'isAdmin', function(){
    return view('admin');
}]);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
