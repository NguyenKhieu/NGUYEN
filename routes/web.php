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

//Route::resource('Hocsinh','HocSinhController');

Route::get('admincp/hocsinh',function (){
    return view('restful.list');
});


Route::resource('products','ProductController');

//Admin:

//Route::get('admincp', function () {
//    return view('admin.pages.index');
//});


//Route::get('getproducttype','AjaxController@getProductType');

Route::group(['prefix' => 'admincp','middleware'=>'adminLogin'],function (){
    Route::get('/', function () {
        return view('admin/index');
    });
    Route::get('show_category','CategoryController@showView');
   Route::resource('category','CategoryController');



    Route::resource('producttype','ProductTypeController');
    Route::get('show_producttype','ProductTypeController@showView');
    route::get('search','ProductTypeController@timkiem');



});

Route::get('login','UserController@GetloginAdmin')->name('setlogin');
Route::post('login','UserController@PostloginAdmin')->name('getlogin');
Route::get('logout','UserController@GetlogoutAdmin')->name('getlogout');


Route::post('timkiem','Controller@timkiem');
