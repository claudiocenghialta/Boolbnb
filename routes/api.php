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
//serve? forse no
Route::post('sponsor', 'API\SponsorApartmentController@store')->name('sponsor.store');
Route::get('apartments/{apartment}', 'API\ApartmentController@apartments');
Route::get('apartments', 'API\ApartmentController@index');
Route::get('search', 'API\ApartmentController@search');
Route::get('attivaApp', 'API\ApartmentController@attivaApp');
Route::get('statistiche', 'API\ApartmentController@statistiche');
