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

Route::get('/', 'HomeController@home');

Route::post('/reqBranches', 'TerminalController@reqBranches');
Route::resource('company','CompanyController');
Route::resource('branch','BranchController');
Route::resource('terminal','TerminalController');
Route::resource('vendor','VendorController');
Route::resource('customer','CustomerController');
Route::resource('inventory','InventoryController');
