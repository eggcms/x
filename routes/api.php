<?php
use Illuminate\Http\Request;

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
Route::resource('/line/','Api\LineController');
Route::get('/data/item/', 'Api\DataController@index');
Route::get('/stepdata/', 'Api\DataController@stepdata');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
