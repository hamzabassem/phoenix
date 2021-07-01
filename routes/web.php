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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    // authentication routs
    Route::get('/login', 'AuthController@login')->name('login');
    Route::post('/auth', 'AuthController@auth')->name('auth');
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::get('/signup/{days}', 'StoreController@create')->name('signup');
    Route::get('/signupstore/{store}', 'UserController@create')->name('signupstore');
    Route::post('/registercompany', 'StoreController@store')->name('registercompany');
    Route::post('/registeruser', 'UserController@store')->name('registeruser');


    Route::prefix('dashboard')->middleware('auth')->group(function () {

        // dash home routes
        Route::get('/', 'DashboardController@index')->name('dashhome');
        Route::get('/edituser', 'UserController@edit')->name('edituser');
        Route::post('/updateuser', 'UserController@update')->name('updateuser');
        Route::get('/updatedays/{days}', 'UserController@updatedays')->name('updatedays');
        Route::post('/addtask', 'TaskController@store')->name('addtask');
        Route::get('/adduser','UserController@createUser')->name('adduser');
        Route::Post('/storeuser','UserController@storeUser')->name('storeuser');
        Route::get('/trash','DashboardController@create')->name('trash');
        Route::get('/restoretransaction/{id}','DashboardController@restoreT')->name('restorei');
        Route::get('/restorecategory/{id}','DashboardController@restoreC')->name('restorec');
        Route::get('/finaldeletetransaction/{id}','DashboardController@destroyT')->name('deletei');
        Route::get('/finaldeletecategory/{id}','DashboardController@destroyC')->name('deletec');
        Route::get('/emptytrash','DashboardController@emptyall')->name('empty');
        Route::get('/employees','UserController@index')->name('employees');
        Route::get('/editemployee/{id}','UserController@show')->name('editemployee');
        Route::post('/updateemployee/{id}','UserController@updateEmployee')->name('updateemployee');
        Route::get('/deleteemployee/{id}','UserController@destroy')->name('deleteemployee');


        // manager routes
        Route::get('/manager', 'ManagerController@index')->name('manager');
        Route::get('/deleteuser/{id}', 'ManagerController@destroy')->name('deleteuser');
        Route::get('/editmanagerinfo', 'ManagerController@edit')->name('editmanagerinfo');
        Route::post('/updatemanager', 'ManagerController@update')->name('updatemanager');
        Route::get('/addmanager', 'ManagerController@create')->name('addmanager');
        Route::post('/storemanager', 'ManagerController@store')->name('storemanager');

        // category routes
        Route::get('/categoriesinfo', 'CategoryController@index')->name('categoriesinfo');
        Route::get('/addcategory', 'CategoryController@create')->name('addcategory');
        Route::post('/storecategory', 'CategoryController@store')->name('storecategory');
        Route::get('/editcategory/{id}', 'CategoryController@edit')->name('editcategory');
        Route::post('/updatecategory/{id}', 'CategoryController@update')->name('updatecategory');
        Route::post('/searchCategory', 'CategoryController@searchC')->name('searchCategory');
        Route::get('/deletecategory/{id}', 'CategoryController@destroy')->name('deletecategory');


        // transactions routes
        Route::get('/items/{id}', 'TransactionController@index')->name('items');
        Route::get('/operation/{id}/{action}', 'TransactionController@create')->name('operation');
        Route::post('/storeitem', 'TransactionController@store')->name('storeitem');
        Route::get('/edititem/{id}', 'TransactionController@edit')->name('edititem');
        Route::post('/updateitem/{id}', 'TransactionController@update')->name('updateitem');
        Route::get('/deleteitem/{id}', 'TransactionController@destroy')->name('deleteitem');
        Route::get('/imports', 'TransactionController@imports')->name('imports');
        Route::get('/exports', 'TransactionController@exports')->name('exports');
        Route::get('/pdf/{id}', 'TransactionController@createPDF')->name('pdf');

        //customers routes
        Route::get('/customersinfo', 'CustomerController@index')->name('customersinfo');
        Route::get('/addcustomer', 'CustomerController@create')->name('addcustomer');
        Route::post('storecustomer', 'CustomerController@store')->name('storecustomer');
        Route::get('/editcustomer/{id}', 'CustomerController@edit')->name('editcustomer');
        Route::post('/updatecustomer/{id}', 'CustomerController@update')->name('updatecustomer');

        //suppliers routes
        Route::get('/suppliersinfo', 'SupplierController@index')->name('suppliersinfo');
        Route::get('/addsupplier', 'SupplierController@create')->name('addsupplier');
        Route::post('storesupplier', 'SupplierController@store')->name('storesupplier');
        Route::get('/editsupplier/{id}', 'SupplierController@edit')->name('editsupplier');
        Route::post('/updatesupplier/{id}', 'SupplierController@update')->name('updatesupplier');


        //import bill routes
        Route::get('/importinfo', 'EmportBillController@index')->name('importinfo');
        Route::get('/addimport', 'EmportBillController@create')->name('addimport');
        Route::post('storeimport', 'EmportBillController@store')->name('storeimport');
        Route::get('/editimport/{id}', 'EmportBillController@edit')->name('editimport');
        Route::get('/deleteimport/{id}', 'EmportBillController@destroy')->name('deleteimport');


        //export bill routes
        Route::get('/exportinfo', 'ExportBillController@index')->name('exportinfo');
        Route::get('/addexport', 'ExportBillController@create')->name('addexport');
        Route::post('storeexport', 'ExportBillController@store')->name('storeexport');
        Route::get('/editexport/{id}', 'ExportBillController@edit')->name('editexport');
        Route::get('/deleteexport/{id}', 'ExportBillController@destroy')->name('deleteexport');




    });

    Route::get('/', 'frontsiteController@index')->name('home');
    Route::get('/pricing', 'frontsiteController@create')->name('pricing');


});





