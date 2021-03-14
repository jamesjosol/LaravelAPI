<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Client;

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

Route::get('/client/balance', 'ClientController@balance');

Route::get('/client/dividend', 'ClientController@dividend');

Route::get('/client/{client}', 'ClientController@show');

Route::post('/client', 'ClientController@store');

Route::patch('/client/{client}/deposit/{amount}', 'ClientController@deposit');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
