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

Route::resource('home', 'HomeController');

Auth::routes();
//Route::get('advert/{id}', 'AdvertController@destroy');

//Route::resource('advert', 'AdvertController');
Route::get('advert/advertcreate', 'AdvertController@advertCreate')->name('advert.advertcreate');
Route::get('advert/store', 'AdvertController@store')->name('advert.store');
Route::post('advert/initializeAd', 'AdvertController@initializeAd')->name('advert.initializeAd');
Route::get('advert/destroy', 'AdvertController@destroy')->name('advert.destroy');
Route::get('advert/create', 'AdvertController@create')->name('advert.create');
Route::get('advert/{advert}', 'AdvertController@show')->name('advert.show');
Route::get('advert/{id}/edit', 'AdvertController@edit')->name('advert.edit');
Route::post('advert/update/{id}', 'AdvertController@update')->name('advert.update');

Route::resource('category', 'CategoryController');
Route::resource('categories', 'CategoryController');

Route::resource('admin', 'AdminController');



Route::resource('city', 'CityController');
Route::post('city/clear', 'CityController@clear')->name('city.clear');


Route::resource('comment', 'CommentController');

Route::get('message/create', 'MessageController@create')->name('message.create');
Route::get('message/store', 'MessageController@store')->name('message.store');
Route::get('user/message/{id}', 'MessageController@show')->name('message.show');
Route::get('user/messages', 'MessageController@index')->name('messages.index');

Route::get('attributes', 'AttributesController@index')->name('attributes.index');
Route::get('attributes/storeset', 'AttributesController@storeSet')->name('attributes.storeSet');
Route::get('attributes/storeattribute', 'AttributesController@storeAttribute')->name('attributes.storeAttribute');



