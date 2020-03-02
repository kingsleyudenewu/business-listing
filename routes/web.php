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

Auth::routes([
    'register' => false,
    'verify' => true
]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/listing', 'BusinessListingController@index')->name('business.listing.index');

Route::group(['middleware' => ['auth']], function (){
    Route::post('/listing', 'BusinessListingController@store')->name('business.listing.store');
    Route::get('/listing/{id}', 'BusinessListingController@show')->name('business.listing.show');
    Route::patch('/listing/{id}', 'BusinessListingController@update')->name('business.listing.update');
    Route::resource('category', 'CategoryController');
});
