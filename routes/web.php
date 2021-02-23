<?php

use Illuminate\Support\Facades\Route;

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


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        // authentication routs
        Route::get('/login','AuthController@login')->name('login');
        Route::post('/auth','AuthController@auth')->name('auth');
        Route::get('/logout','AuthController@logout')->name('logout');
        Route::get('/signup/{days}','UserController@create')->name('signup');
        Route::post('/registeruser','UserController@store')->name('registeruser');



    Route::prefix('dashboard')->middleware('auth')->group(function(){

        // dash home routes
        Route::get('/','DashboardController@index')->name('dashhome');
        Route::get('/edituser','UserController@edit')->name('edituser');
        Route::post('/updateuser','UserController@update')->name('updateuser');
        Route::get('/updatedays/{days}','UserController@updatedays')->name('updatedays');


        // manager routes
        Route::get('/manager','ManagerController@index')->name('manager');
        Route::get('/deleteuser/{id}','ManagerController@destroy')->name('deleteuser');
        Route::get('/editmanagerinfo','ManagerController@edit')->name('editmanagerinfo');
        Route::post('/updatemanager','ManagerController@update')->name('updatemanager');
        Route::get('/addmanager','ManagerController@create')->name('addmanager');
        Route::post('/storemanager','ManagerController@store')->name('storemanager');

        // category routes
        Route::get('/categoriesinfo','CategoryController@index')->name('categoriesinfo');
        Route::get('/addcategory','CategoryController@create')->name('addcategory');
        Route::post('/storecategory','CategoryController@store')->name('storecategory');
        Route::get('/editcategory/{id}','CategoryController@edit')->name('editcategory');
        Route::post('/updatecategory/{id}','CategoryController@update')->name('updatecategory');
        Route::get('/deletecategory/{id}','CategoryController@destroy')->name('deletecategory');


        // items routes
        Route::get('/items/{id}','ItemController@index')->name('items');
        Route::get('/operation/{id}/{action}','ItemController@create')->name('operation');
        Route::post('/storeitem','ItemController@store')->name('storeitem');
        Route::get('/edititem/{id}','ItemController@edit')->name('edititem');
        Route::post('/updateitem/{id}','ItemController@update')->name('updateitem');
        Route::get('/deleteitem/{id}','ItemController@destroy')->name('deleteitem');
        Route::get('/imports','ItemController@imports')->name('imports');
        Route::get('/exports','ItemController@exports')->name('exports');
        Route::get('/pdf/{id}','ItemController@createPDF')->name('pdf');







    });

Route::get('/','frontsiteController@index')->name('home');
Route::get('/pricing','frontsiteController@create')->name('pricing');








});





