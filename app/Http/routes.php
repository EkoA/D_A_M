<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/items/department/{id}', [
	'uses' => 'ItemController@department',
	'as' => 'items.department'
]);

Route::get('/users/email', [
	'uses' => 'UserController@sendEmailReminder',
	'as' => 'emails.reminder'
]);

Route::get('/',[
	'uses' => 'UserController@checker',
	'as' => 'home'
]);

Route::get('/departments/{id}/decline/', [
	'uses' => 'DepartmentController@decline',
	'as' => 'departments.decline'
]);

//Routes for Orders
Route::get('/orders/pending/', [
	'uses' => 'OrderController@pending',
	'as' => 'orders.pending'
]);

Route::get('/orders/decline/', [
	'uses' => 'OrderController@pending',
	'as' => 'orders.decline'
]);

Route::get('/orders/sent/', [
	'uses' => 'OrderController@sent',
	'as' => 'orders.sent'
]);

Route::get('/orders/search/', [
	'uses' => 'OrderController@search',
	'as' => 'orders.search'
]);

Route::put('/orders/orderdecision/{id}', [
	'uses' => 'OrderController@orderdecision',
	'as' => 'orders.orderdecision'
]);

Route::get('/orders/reports/', [
	'uses' => 'OrderController@reports',
	'as' => 'orders.reports'
]);

Route::post('/orders/reportgen/', [
	'uses' => 'OrderController@reportgen',
	'as' => 'orders.reportgen'
]);

//Routes for Departments
Route::get('/departments/pending/', [
	'uses' => 'DepartmentController@pending',
	'as' => 'departments.pending'
]);

Route::get('/departments/deptcreate/', [
	'uses' => 'DepartmentController@deptcreate',
	'as' => 'departments.deptcreate'
]);

//Routes for Users
Route::get('/users/search/', [
	'uses' => 'UserController@search',
	'as' => 'users.search'
]);

Route::post('/users/{id}/changepassword/', [
	'uses' => 'UserController@changepassword',
	'as' => 'users.changepassword'
]);

Route::get('/users/addstaff/', [
	'uses' => 'UserController@addstaff',
	'as' => 'users.addstaff'
]);

Route::get('/users/viewstaff/', [
	'uses' => 'UserController@viewstaff',
	'as' => 'users.viewstaff'
]);

Route::get('/users/resetpassword/{id}', [
	'uses' => 'UserController@resetpassword',
	'as' => 'users.resetpassword'
]);

Route::get('/users/blockuser/{id}', [
	'uses' => 'UserController@blockuser',
	'as' => 'users.blockuser'
]);

Route::get('/users/activatemail/{id}', [
	'uses' => 'UserController@activatemail',
	'as' => 'users.activatemail'
]);


//Routes for Items
Route::get('/items/reports/', [
	'uses' => 'ItemController@reports',
	'as' => 'items.reports'
]);

Route::post('/items/reportgen/', [
	'uses' => 'ItemController@reportgen',
	'as' => 'items.reportgen'
]);

Route::get('/items/search/', [
	'uses' => 'ItemController@search',
	'as' => 'items.search'
]);

Route::get('/items/depreciate/', [
	'uses' => 'ItemController@depreciate',
	'as' => 'items.depreciate'
]);

Route::get('/items/dispose/{id}', [
	'uses' => 'ItemController@dispose',
	'as' => 'items.dispose'
]);

Route::put('/items/dispose/{id}', [
	'uses' => 'ItemController@assetdecision',
	'as' => 'asset.assetdecision'
]);

Route::put('/items/disposal/{id}', [
	'uses' => 'ItemController@disposal',
	'as' => 'items.disposal'
]);

Route::post('/items/generateReport/', [
	'uses' => 'ItemController@generateReport',
	'as' => 'items.generateReport'
]);

Route::get('/items/masscreate/', [
	'uses' => 'ItemController@masscreate',
	'as' => 'items.masscreate'
]);

Route::post('/items/masscreate/', [
	'uses' => 'ItemController@massstore',
	'as' => 'items.massstore'
]);


//Routes for basic
Route::get('/basic/sent/', [
	'uses' => 'BasicController@sent',
	'as' => 'basic.sent'
]);

Route::get('/basic/show/{id}', [
	'uses' => 'BasicController@show',
	'as' => 'basic.show'
]);

Route::get('/basic/{id}/edit', [
	'uses' => 'BasicController@edit',
	'as' => 'basic.edit'
]);

Route::put('/basic/update/{id}', [
	'uses' => 'BasicController@update',
	'as' => 'basic.update'
]);


//Routes for Asset
Route::get('/asset/', [
	'uses' => 'ItemController@asset',
	'as' => 'asset.index'
]);

Route::get('/asset/show/{id}', [
	'uses' => 'ItemController@assetshow',
	'as' => 'asset.show'
]);

Route::get('/asset/disposalpending/', [
	'uses' => 'ItemController@disposalpending',
	'as' => 'asset.disposalpending'
]);

Route::put('/asset/disposalpending/{id}', [
	'uses' => 'ItemController@assetdisposal',
	'as' => 'asset.assetdisposal'
]);

Route::get('/asset/create/', [
	'uses' => 'ItemController@assetcreate',
	'as' => 'asset.create'
]);

Route::get('/asset/pending/', [
	'uses' => 'ItemController@assetpending',
	'as' => 'asset.pending'
]);

Route::put('/asset/assetdecision/{id}', [
	'uses' => 'ItemController@assetdecision',
	'as' => 'asset.assetdecision'
]);

Route::get('/asset/{id}/edit', [
	'uses' => 'ItemController@assetedit',
	'as' => 'asset.edit'
]);

Route::put('/asset/massdecision/', [
	'uses' => 'ItemController@massdecision',
	'as' => 'asset.massdecision'
]);


//Routes for Finance
Route::get('/finances/items/', [
	'uses' => 'ItemController@index',
	'as' => 'finances.items'
]);

Route::get('/finances/items/create/', [
	'uses' => 'ItemController@create',
	'as' => 'finances.create'
]);

Route::get('/finances/items/{id}/', [
	'uses' => 'ItemController@show',
	'as' => 'finances.show'
]);

Route::get('/finances/pending/', [
	'uses' => 'FinanceController@pending',
	'as' => 'finances.pending'
]);

Route::get('/finances/approved/', [
	'uses' => 'FinanceController@approved',
	'as' => 'finances.approved'
]);

Route::post('/finances/generateReport/', [
	'uses' => 'FinanceController@generateReport',
	'as' => 'finances.generateReport'
]);

Route::get('/finances/{id}/decline/', [
	'uses' => 'FinanceController@decline',
	'as' => 'finances.decline'
]);

Route::get('/finances/order/', [
	'uses' => 'FinanceController@order',
	'as' => 'finances.order'
]);

//classifications
Route::post('/classifications/generateReport/', [
	'uses' => 'ClassificationController@generateReport',
	'as' => 'classifications.generateReport'
]);

Route::auth();

/*Route::post('/classification/{id}/destroy/', [
	'uses' => 'ClassificationController@changepassword',
	'as' => 'classifications.destroy'
]);*/

Route::resource('/classifications', 'ClassificationController');

Route::get('/home', 'HomeController@index');

Route::get('/', [
	'uses' => 'HomeController@index',
	'as' => 'home'
]);

Route::resource('/departments', 'DepartmentController');

Route::resource('/items', 'ItemController');

Route::resource('/orders', 'OrderController');

Route::resource('/users', 'UserController');

Route::resource('/finances', 'FinanceController');

Route::resource('/vendors', 'VendorController');
