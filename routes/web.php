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

//Route::get('/', 'PagesController@root')->name('root');
Route::get('alipay', function() {
   return app('alipay')->web([
       'out_trade_no' => time(),
       'total_amount' => '1',
       'subject' => 'test subject - 测试',
   ]);
});
Route::get('/test', 'TestController@index');
Auth::routes();

Route::get('/github/login', 'LoginController@login');
Route::get('/github/callback', 'LoginController@callback');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
   Route::get('/email_verify_notice', 'PagesController@emailVerifyNotice')->name('email_verify_notice');
   Route::get('/email_verification/verify', 'EmailVerificationController@verify')->name('email_verification.verify');
   Route::get('/email_verification/send', 'EmailVerificationController@send')->name('email_verification.send');
   Route::group(['middleware' => 'email_verified'], function() {
      // Route::get('/test', function() {
      //   return 'Your email is verified';
      // });
      Route::get('user-addresses', 'UserAddressesController@index')->name('user_addresses.index');
      Route::get('user_addresses/{user_address}', 'UserAddressesController@edit')->name('user_addresses.edit');
      Route::get('user-addresses/create', 'UserAddressesController@create')->name('user_addresses.create');
      Route::post('user-addresses', 'UserAddressesController@store')->name('user_addresses.store');
      Route::get('user-addresses/{user_address}', 'UserAddressesController@edit')->name('user_addresses.edit');
      Route::put('user-addresses/{user_address}', 'UserAddressesController@update')->name('user_addresses.update');
      Route::delete('user_addresses/{user_address}', 'UserAddressesController@destroy')->name('user_addresses.destroy');
      Route::post('products/{product}/favorite', 'ProductsController@favor')->name('products.favor');
      Route::delete('products/{product}/favorite', 'ProductsController@disfavor')->name('products.disfavor');
      Route::get('products/favorites', 'ProductsController@favorites')->name('products.favorites');

      Route::post('cart', 'CartController@add')->name('cart.add');
      Route::get('cart', 'CartController@index')->name('cart.index');
      Route::delete('cart/{sku}', 'CartController@remove')->name('cart.remove');
      Route::post('orders', 'OrdersController@store')->name('orders.store');
   });
});
Route::redirect('/', '/products')->name('root');
Route::get('products', 'ProductsController@index')->name('products.index');
Route::get('products', 'ProductsController@index')->name('products.index');
Route::get('products/{product}', 'ProductsController@show')->name('products.show');

Route::get('test/sendmail', 'TestController@sendMail');