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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/who', function () {
    return 'WTF are you?';
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//注意路由的写法，使用resource关键字，另外，路由使用复数，
Route::resource('companies','CompaniesController');
Route::resource('projects','ProjectsController');
Route::resource('roles','RolesController');
Route::resource('task','TasksController');
Route::resource('users','UsersController');

//我自己的写法
Route::resource('products','ProductsController');

Route::group(['middleware' => ['auth']], function () {

    Route::get('classes/create/{warehouse?}', 'ClassesController@create');


    Route::prefix('admin')->group(function () {
        Route::namespace('Admin')->group(function () {
            Route::resource('warehouses','WarehousesController');
            Route::get('products/{product}','ProductsController@show');
            Route::get('products/{product}/edit','ProductsController@edit');
//            Route::resource('products','ProductsController');




        });

    });




});


