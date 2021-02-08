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


# Guest 
Route::group([
  'middleware' => 'api',
  'prefix' => 'auth'
], function () {
  Route::post('/register', 'JWTAuthController@register');
  Route::post('/login', 'JWTAuthController@login');
});

Route::group([
  'middleware' => 'api',
  'prefix' => 'guest'
], function () {
  Route::get('/{wedding_id}/{participant_id}', 'GuestController@one');
  Route::post('/{wedding_id}', 'GuestController@add');
  Route::put('/{wedding_id}/{participant_id}', 'GuestController@edit');
});


# JWT Authorize
Route::group([
  'middleware' => 'api',
  'prefix' => 'user'
], function () {
  Route::post('/logout', 'JWTAuthController@logout');
  Route::post('/refresh', 'JWTAuthController@refresh');
  Route::get('/profile', 'JWTAuthController@profile');
});

Route::group([
  'middleware' => 'auth.jwt',
  'prefix' => 'manage'
], function () {
  # Wedding 
  Route::get('/weddings', 'WeddingController@all');
  Route::get('/weddings/{wedding_id}', 'WeddingController@one');
  Route::post('/weddings', 'WeddingController@add');
  Route::put('/weddings/{wedding_id}', 'WeddingController@edit');
  Route::delete('/weddings/{wedding_id}', 'WeddingController@delete');
  # Guests
  Route::get('/guests', 'GuestController@all');
  // Route::get('/guests/{participant_id}', 'GuestController@one');
  Route::post('/guests', 'GuestController@add');
  Route::put('/guests/{guest_id}', 'GuestController@edit');
  Route::delete('/guests/{guest_id}', 'GuestController@delete');
  # Forms
  Route::get('/forms', 'FormController@all');
  Route::get('/forms/{form_id}', 'FormController@one');
  Route::post('/forms', 'FormController@add');
  Route::put('/forms/{form_id}', 'FormController@edit');
  Route::delete('/forms/{form_id}', 'FormController@delete');
});
