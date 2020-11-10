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

Route::group(['middleware' => ['api']], function () {
    //一覧表示
    Route::get('vehicles','Api\VehicleController@index');
    //指定した車両を取得
    Route::get('vehicles/{id}','Api\VehicleController@show');
    //新規登録
    Route::post('vehicles','Api\VehicleController@store');
    //アップデート
    Route::put('vehicles/{id}','Api\VehicleController@update');
});