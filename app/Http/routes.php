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
// Route::get('/directive/produk', function(){
//     // return view('modules.sites.upload.index');
// 		return view('pms/produk');
// });

// Route::get('/', function () {
//     return view('welcome');
//     // return view('pms/produk');
//     // return view('pms/index');
// });

Route::auth();
Route::get('/token', 'Auth\TokenController@getToken');

Route::group(['middleware'=>['menus']], function(){
	Route::get('/home', 'sites\snController@index');
	Route::get('/', 'sites\snController@index');
});

Route::group(['middleware'=>['menus']], function(){
	Route::get('/{jenis}/{module}/menu', 'sites\menuController@index');
});

Route::group(['prefix'=>'mst', 'middleware'=>['menus']], function(){ //show view
	Route::get('pms/produk', 'PMS\produkController@_index');
	Route::get('pms/libur', 'PMS\liburController@_index');
	Route::get('pms/customer', 'PMS\customerController@_index');
	Route::get('hkm/spks', 'HKM\spksController@_index');
});

Route::group(['prefix'=>'trx', 'middleware'=>['menus']], function(){ //show view
	Route::get('pms/pnwrMst', 'PMS\pnwrMstController@_index');
	Route::get('pms/fpMst', 'PMS\fpMstController@_index');
});

Route::group(['prefix'=>'rpt'], function(){ //show view
	Route::get('{fileType}/pms/customer', 'PMS\customerController@_RekapCustomer');
});

Route::group(['prefix'=>'pms'], function(){ //return dalam bentuk json
	Route::resource('produk', 'PMS\produkController');
	Route::resource('tarif', 'PMS\tarifController');
	Route::resource('libur', 'PMS\liburController');
	Route::resource('customer', 'PMS\customerController');
	Route::resource('pnwrMst', 'PMS\pnwrMstController');
	Route::resource('pnwrTayang', 'PMS\pnwrTayangController');
	Route::resource('pnwrMateri', 'PMS\pnwrMateriController');
	Route::resource('fpMst', 'PMS\fpMstController');
	Route::resource('fpDet', 'PMS\fpDetController');
	Route::put('pnwrMst/spks/{pnwrMst}', 'PMS\pnwrMstController@_saveSpks');
	// Route::get('order/spks', 'PMS\')
});

Route::group(['prefix'=>'hkm'], function(){
	Route::resource('spks', 'HKM\spksController');
	Route::get('spks/{spks}/apv', 'HKM\spksController@_getDefaultApv');
	Route::put('spks/{spks}/apv', 'HKM\spksController@_setApv');
	Route::get('spks/files/{dir}/{fileName}', 'HKM\spksController@_getFiles');
	Route::delete('spks/files/{id_spks}/{dir}/{fileName}', 'HKM\spksController@_delFiles');
});


Route::group(['prefix'=>'prod'], function(){
	Route::resource('realisasi', 'PROD\realisasiController');
});

Route::group(['prefix'=>'check'], function(){
	Route::get('pms/pnwrMst', 'PMS\pnwrMstController@getForFaktur');
});
// Route::group(['prefix'=>'files'], function(){
// 	Route::get('hkm/{fileName}', 'HKM\spksController@_getFiles');
// });






