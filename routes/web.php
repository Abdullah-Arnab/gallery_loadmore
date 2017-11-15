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
//
//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/', 'pageController@index');
Route::get('/home', 'pageController@home');

Route::get('my-product', 'PageController@myProduct');
Route::post('view-counter', 'PageController@addView');
Route::post('like-counter', 'PageController@addLike');
Route::get('image-upload','PageController@imageUpload');
Route::post('image-upload','PageController@imageUploadPost');

//Intervention

Route::get('resizeImage', 'PageController@resizeImage');
Route::post('resizeImagePost',['as'=>'resizeImagePost','uses'=>'PageController@resizeImagePost']);

