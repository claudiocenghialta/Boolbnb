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

//route homepage per guest e admin
Route::get('/', 'Guest\ApartmentController@index')->name('welcome');
//route per show guest
Route::get('/apartments/{apartment}', 'Guest\ApartmentController@show')->name('guest.apartments.show');


Auth::routes();

// aggiunta prefisso per cartella admin
Route::prefix('admin')->namespace('Admin')->middleware('auth')->group(function () {
  Route::get('/home', 'HomeController@index')->name('home');
  Route::resource('apartments', 'ApartmentController');
  // Route::get('apartments/show/{slug}','ApartmentController@show')->name('apartments.slug');
  Route::resource('images', 'ImageController');
  Route::resource('users', 'UserController');
  Route::resource('messages', 'MessageController');
  // Route::delete('/image/destroy/{image}', 'ImageController@destroy')->name('image.destroy');

  // pagamenti prova

  //BRAINTREE
  Route::get('payment', 'PaymentController@index')->name('payment.index');

  Route::post('payment/checkout', 'PaymentController@paga')->name('paga');


});
