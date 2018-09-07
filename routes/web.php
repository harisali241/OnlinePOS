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
    Route::get('/home', 'HomeController@home')->name('home');
    Route::get('/', 'HomeController@home')->name('home');
    

    Route::post('/reqBranches', 'HomeController@reqBranches');
    Route::resource('company', 'CompanyController');
    Route::resource('branch', 'BranchController');
    Route::resource('terminal', 'TerminalController');
    Route::resource('users', 'UserController');
    Route::resource('vender', 'VendorController');
    Route::resource('customer', 'CustomerController');
    Route::resource('inventory', 'InventoryController');
    Route::resource('nature', 'AccountNatureController');
    Route::resource('account', 'AccountController');
    Route::resource('customer', 'CustomerController');
    Route::resource('purchase', 'purchaseController');
    Route::resource('sale', 'SaleController');
    Route::resource('grn', 'grnController');
    Route::resource('pointOfSale', 'PointOfSaleController');

});

Route::post('getSearhItem','PointOfSaleController@getSearhItem');
Route::post('reqPO','grnController@reqPO');
Route::get('/grnComplete', 'grnController@complete');
Route::get('/purchaseapprove', 'purchaseController@approve');
Route::post('aprovel', 'purchaseController@aprovel');
/*Ajax Routes*/
Route::get('check_username','AjaxController@check_usernames');
Route::get('check_username_edit','AjaxController@check_usernames_edit');
Route::get('get_terminals','AjaxController@terminal_fetch');
Route::get('get_accounts','AjaxController@account_fetch');
Route::resource('accountsetting', 'AccountSettingController');
