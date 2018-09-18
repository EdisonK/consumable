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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::namespace('Admin')->group(function () {
    //仓库相关
    Route::post('warehouses/{warehouse}','WarehousesController@update');
    Route::post('warehouses','WarehousesController@store');
    Route::delete('warehouses/{warehouse}','WarehousesController@destroy');

    //二级分类相关
    Route::post('classes/{class}','ClassesController@update');
    Route::post('classes','ClassesController@store');
    Route::delete('classes/{class}','ClassesController@destroy');

    //三级分类相关
    Route::post('categories/{category}','CategoriesController@update');
    Route::post('categories','CategoriesController@store');
    Route::delete('categories/{category}','CategoriesController@destroy');





});