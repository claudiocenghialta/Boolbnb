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

// tolta home inutile
// Route::get('/payment', function () {
//     $gateway = new Braintree\Gateway([
//       'environment' => getenv('BT_ENVIRONMENT'),
//       'merchantId' => getenv('BT_MERCHANT_ID'),
//       'publicKey' => getenv('BT_PUBLIC_KEY'),
//       'privateKey' => getenv('BT_PRIVATE_KEY')
//   ]);
//     return view('payment');
// });

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

  // Route::get('/payment', function () {
  //     $gateway = new Braintree\Gateway([
  //       'environment' => config('services.braintree.environment'),
  //       'merchantId' => config('services.braintree.merchantId'),
  //       'publicKey' => config('services.braintree.publicKey'),
  //       'privateKey' => config('services.braintree.privateKey')
  //   ]);
  //
  //   $token = $gateway->ClientToken()->generate();
  //   // dd($token);
  //     return view('admin.payment', [
  //       'token' => $token
  //     ]);
  // });


});
