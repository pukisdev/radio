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
	// Route::get('/home', 'sites\snController@index');
	Route::get('/', 'sites\snController@index');

});

Route::group(['middleware'=>['menus']], function(){
	Route::get('/{jenis}/{module}/menu', 'sites\menuController@index');
	Route::get('/profile', 'sites\profileController@index');
});

Route::group(['prefix'=>'mst', 'middleware'=>['menus']], function(){ //show view
	Route::get('pms/produk', 'PMS\produkController@_index');
	Route::get('pms/libur', 'PMS\liburController@_index');
	Route::get('pms/customer', 'PMS\customerController@_index');
	Route::get('hkm/spks', 'HKM\spksController@_index');

	Route::get('keu/penerimaan', 'keu\penerimaanMstController@_index');
	Route::get('keu/pembayaran', 'keu\pembayaranMstController@_index');
	Route::get('keu/setoran_bank', 'keu\setoranBankController@_index');
	Route::get('keu/nomor_faktur_pajak', 'keu\nomorFPajakController@_index');

	Route::get('keu/bank', 'keu\bankController@_index');
	Route::get('keu/npb', 'keu\npbController@_index');
	Route::get('keu/accCoa', 'keu\accCoaController@_index');
	Route::get('keu/cost_center', 'keu\costCenterController@_index');
	Route::get('keu/kwitansi', 'keu\kwitansiController@_index');
	Route::get('sdm/pegawai', 'sdm\pegawaiMstController@_index');
});

Route::group(['prefix'=>'trx', 'middleware'=>['menus']], function(){ //show view
	Route::get('pms/pnwrMst', 'PMS\pnwrMstController@_index');
	Route::get('pms/fpMst', 'PMS\fpMstController@_index');
	Route::get('keu/penerimaan', 'keu\penerimaanMstController@_index');
	Route::get('keu/pembayaran', 'keu\pembayaranMstController@_index');
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

Route::group(['prefix'=>'keu'], function(){ 
	Route::resource('penerimaan', 'keu\penerimaanMstController');
	Route::resource('pembayaran', 'keu\pembayaranMstController');

	Route::resource('setoran_bank', 'keu\setoranBankController');
	Route::resource('bank', 'keu\bankController');
	Route::resource('jns_trans', 'keu\jnsTransController');
	Route::resource('npb', 'keu\npbController');
	Route::resource('accCoa', 'keu\accCoaController');
	Route::resource('cost_center', 'keu\costCenterController');
	Route::resource('penerimaan/det', 'keu\penerimaanDetController');
	Route::resource('kwitansi', 'keu\kwitansiController');

	Route::get('seri_sb','keu\penerimaanDetController@seriSetoranBank');
	Route::get('fpajak', 'keu\kwitansiController@getFpajak');
	Route::get('maxFpajak', 'keu\kwitansiController@getMaxFpajak');
	//Route::resource('bank', 'keu\bankMstController');
});

Route::group(['prefix'=>'acc'], function(){ 
	Route::resource('coas', 'acc\coasMstController');
	Route::get('coas/ap/cst','acc\coasMstController@_coas_ap');
	Route::get('coas/ap/pms_cst','acc\coasMstController@coas_pms_customer');
	Route::get('lovFakturPiutang','acc\fakturPiutangController@_lovFakturPiutang');
	Route::get('lovFakturHutang','acc\fakturHutangController@_lovFakturHutang');
});

Route::group(['prefix'=>'umum'], function(){
	Route::resource('supplier', 'umum\supplierController');
});

Route::group(['prefix'=>'sdm'], function(){
	Route::resource('pegawai', 'sdm\pegawaiMstController');
});


Route::group(['prefix'=>'check'], function(){
	Route::get('pms/pnwrMst', 'PMS\pnwrMstController@getForFaktur');
});


Route::group(['prefix'=>'sites'], function(){
	Route::put('profile/password', 'sites\profileController@changePassword');
});
// Route::group(['prefix'=>'files'], function(){
// 	Route::get('hkm/{fileName}', 'HKM\spksController@bank');
//bank
