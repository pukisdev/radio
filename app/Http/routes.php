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

Route::get('/', function () {
    return view('welcome');
    // return view('pms/produk');
    // return view('pms/index');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['prefix'=>'check'], function(){
	Route::get('pms/pnwrMst', 'PMS\pnwrMstController@getForFaktur');
});

Route::group(['prefix'=>'mst'], function(){
	Route::get('pms/produk', 'PMS\produkController@_index');
	Route::get('pms/libur', 'PMS\liburController@_index');
	Route::get('pms/customer', 'PMS\customerController@_index');
	Route::get('pms/pnwrMst', 'PMS\pnwrMstController@_index');
	Route::get('pms/fpMst', 'PMS\fpMstController@_index');
});

Route::group(['prefix'=>'pms'], function(){
	Route::resource('produk', 'PMS\produkController');
	Route::resource('tarif', 'PMS\tarifController');
	Route::resource('libur', 'PMS\liburController');
	Route::resource('customer', 'PMS\customerController');
	Route::resource('pnwrMst', 'PMS\pnwrMstController');
	Route::resource('pnwrTayang', 'PMS\pnwrTayangController');
	Route::resource('pnwrMateri', 'PMS\pnwrMateriController');
	Route::resource('fpMst', 'PMS\fpMstController');
	Route::resource('fpDet', 'PMS\fpDetController');
});

Route::group(['prefix'=>'prod'], function(){
	Route::resource('realisasi', 'PROD\realisasiController');
});






