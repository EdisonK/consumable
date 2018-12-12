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


Route::group(['middleware' => ['auth']], function () {

    //后面要加权限必须登陆的才行
    Route::post('orders','OrdersController@store');
    Route::post('orders/batch','OrdersController@batchConfirm');
    Route::get('orders','OrdersController@index');
    Route::resource('products','ProductsController');

    //损耗
    Route::get('losses','LossesController@index');
    Route::post('losses','LossesController@store');

    //库存
    Route::get('inventories','InventoriesController@index');
    Route::get('private-inventories','PrivateInventoriesController@index');

    //用户自己重新设置密码
    Route::post('users/reset/{user}','UsersController@reset');
    Route::get('users/{user}','UsersController@show');




    Route::prefix('admin')->group(function () {
        Route::namespace('Admin')->group(function () {
//            Route::get('warehouses','WarehousesController@index');
            Route::get('products','ProductsController@index');
            Route::get('products/create','ProductsController@create');
            Route::post('products','ProductsController@store');
            Route::get('products/{product}','ProductsController@show');
            Route::delete('products/{product}','ProductsController@destroy');
            Route::get('products/{product}/edit','ProductsController@edit');
            Route::post('products/{product}/update','ProductsController@update');


            //人员管理
            Route::get('users','UsersController@index');
            Route::post('users/on/{user}','UsersController@switchOn');
            Route::post('users/password/{user}','UsersController@resetPassword');
            Route::post('users/roles/{user}','UsersController@setRolesForUser');



            //订单管理
            Route::get('orders','OrdersController@index');
            Route::post('orders','OrdersController@check');


//            Route::resource('products','ProductsController');

            //仓库相关
            Route::post('warehouses/{warehouse}','WarehousesController@update');
            Route::post('warehouses','WarehousesController@store');
            Route::delete('warehouses/{warehouse}','WarehousesController@destroy');

            //二级分类相关
            Route::post('classes/{class}','ClassesController@update');
            Route::get('classes/{warehouse}','ClassesController@getClassesByWarehouseId');
            Route::post('classes','ClassesController@store');
            Route::delete('classes/{class}','ClassesController@destroy');
            Route::get('classes/category/{category}','ClassesController@getClassesByCategoryId');

            //三级分类相关
            Route::post('categories/{category}','CategoriesController@update');
            Route::get('categories/{warehouse}','CategoriesController@getCategoriesByWarehouseId');
            Route::get('categories/class/{class}','CategoriesController@getCategoriesByClassId');
            Route::post('categories','CategoriesController@store');
            Route::delete('categories/{category}','CategoriesController@destroy');





        });

    });




});


