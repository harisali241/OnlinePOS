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


Auth::routes();

Route::group(['middleware' => ['auth','admin_security']],function () {
    Route::get('/', 'HomeController@home')->name('home');
    

    Route::post('/reqBranches', 'HomeController@reqBranches');
    Route::resource('company', 'CompanyController');
    Route::resource('branch', 'BranchController');
    Route::resource('terminal', 'TerminalController');
    Route::resource('vender', 'VendorController');
    Route::resource('customer', 'CustomerController');
    Route::resource('inventory', 'InventoryController');
    Route::resource('nature', 'AccountNatureController');
    Route::resource('account', 'AccountController');
    Route::resource('customer', 'CustomerController');
    Route::resource('purchase', 'purchaseController');
    Route::resource('sale', 'SaleController');
<<<<<<< HEAD
    // Route::get('/purchaseapprove', 'purchaseController@approve');

    
    //Route::resource('sale', 'saleController');

=======
    Route::resource('grn', 'grnController');
>>>>>>> 9dd727bbb6d234a48d94b64a5c23c301e500be54


    /*Ajax Routes*/
    Route::get('check_username','AjaxController@check_usernames');
    Route::get('check_username_edit','AjaxController@check_usernames_edit');
});

Route::post('reqPO','grnController@reqPO');
Route::get('/purchaseapprove', 'purchaseController@approve');
Route::post('aprovel', 'purchaseController@aprovel');
