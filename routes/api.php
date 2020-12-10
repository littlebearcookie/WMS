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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/', function () {
  return response(["msg" => "hello"], 200);
});
Route::group([
  'middleware' => 'api',
], function () {
  Route::group([
    'prefix' => 'auth'
  ], function () {
    Route::post('register', 'JWTAuthController@register');
    Route::post('login', 'JWTAuthController@login');
    Route::post('logout', 'JWTAuthController@logout');
    Route::post('refresh', 'JWTAuthController@refresh');
  });
  Route::get('profile', 'JWTAuthController@profile');
});

Route::group([
  'middleware' => 'auth.jwt',
], function () {
  # Wedding 
  Route::get('weddings', 'WeddingController@all');
  Route::post('weddings', 'WeddingController@add');
  Route::put('weddings/{wedding_id}', 'WeddingController@edit');
  Route::delete('weddings/{wedding_id}', 'WeddingController@delete');
  # Participants
  Route::get('weddings/{wedding_id}/participants', 'ParticipantController@all');
  Route::get('weddings/{wedding_id}/participants/{participant_id}', 'ParticipantController@one');
  Route::post('weddings/{wedding_id}/participants', 'ParticipantController@add');
  Route::put('weddings/{wedding_id}/participants/{participant_id}', 'ParticipantController@edit');
  Route::delete('weddings/{wedding_id}/participants/{participant_id}', 'ParticipantController@delete');
});
