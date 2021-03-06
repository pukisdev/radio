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
	
	Route::get('acc/anggaran', 'acc\anggaranMstController@_index');

	// Route::get('keu/penerimaan', 'keu\penerimaanMstController@_index');
	// Route::get('keu/pembayaran', 'keu\pembayaranMstController@_index');
	Route::get('keu/setoran_bank', 'keu\setoranBankController@_index');
	Route::get('keu/nomor_fpajak', 'keu\nomorFPajakController@_index');
	Route::get('keu/bank', 'keu\bankController@_index');
	Route::get('keu/npb', 'keu\npbController@_index');
	Route::get('keu/accCoa', 'keu\accCoaController@_index');
	Route::get('keu/cost_center', 'keu\costCenterController@_index');
	Route::get('keu/bKwitansi/{no_kwitansi}', 'keu\kwitansiController@bKwitansi');

	Route::get('sdm/pegawai', 'sdm\pegawaiMstController@_index');

	Route::get('acc/transAr', 'acc\transArMstController@_index');
	Route::get('acc/coas', 'acc\coasMstController@_index');
	Route::get('acc/perusahaan', 'acc\perusahaanMstController@_index');
	Route::get('acc/tipe_jurnal', 'acc\tipeJurnalMstController@_index');
});

Route::group(['prefix'=>'trx', 'middleware'=>['menus']], function(){ //show view
	Route::get('pms/pnwrMst', 'PMS\pnwrMstController@_index');
	Route::get('pms/fpMst', 'PMS\fpMstController@_index');
	Route::get('keu/penerimaan', 'keu\penerimaanMstController@_index');
	Route::get('keu/pembayaran', 'keu\pembayaranMstController@_index');
	Route::get('keu/transfer_bukti/{jenis}', 'keu\transferNoBuktiController@_index');
});


Route::group(['prefix'=>'rpt', 'middleware' => ['menus']], function(){ //show view
	Route::get('keu/kwitansi', 'keu\kwitansiController@_index');
	Route::get('{fileType}/pms/order', 'PMS\rekapStatusOrderController@_RekapStatusOrder');
	Route::get('{fileType}/pms/customer', 'PMS\customerController@_RekapCustomer');
	Route::get('keu/pKwitansi/{no_kwitansi}', 'keu\kwitansiController@pKwitansi');
	Route::get('keu/pFpajak/{no_kwitansi}', 'keu\kwitansiController@pFpajak');
	Route::get('pms/rekapStatusOrder', 'PMS\rekapStatusOrderController@index');
	
	Route::get('keu/rptPembayaran', 'keu\pembayaranMstController@rptPembayaran');
	Route::post('{fileType}/keu/notaPembayaran', 'keu\pembayaranMstController@rptNotaPembayaran');
	Route::get('keu/rptPenerimaan', 'keu\penerimaanMstController@rptPenerimaan');
	Route::post('{fileType}/keu/notaPenerimaan', 'keu\penerimaanMstController@rptNotaPenerimaan');
	Route::get('keu/rptSetoranBank', 'keu\setoranBankController@rptFormSetoranBank');
	Route::post('{fileType}/keu/setoranBank', 'keu\setoranBankController@rptSetoranBank');
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
	Route::resource('ketCustomer', 'PMS\ketCustomerController');
	Route::resource('jnsKlien', 'PMS\jnsKlienController');
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
	Route::resource('nomor_fpajak', 'keu\nomorFPajakController');

	Route::get('seri_sb','keu\penerimaanDetController@seriSetoranBank');
	Route::get('fpajak', 'keu\kwitansiController@getFpajak');
	Route::get('maxFpajak', 'keu\kwitansiController@getMaxFpajak');
	Route::get('faPembayaran', 'keu\pembayaranMstController@pembayaranMstDet');
	//Route::resource('bank', 'keu\bankMstController');

	Route::post('nomor_fpajak/{nomor_fpajak}/edit', 'keu\nomorFPajakController@edit');
	
	Route::post('transferPenerimaan/cekData', 'keu\transferNoBuktiController@cekData');
	Route::post('transferPenerimaan/proses', 'keu\transferNoBuktiController@transfer');

	Route::post('transferPembayaran/cekData', 'keu\transferPembayaranController@cekData');
	Route::post('transferPembayaran/proses', 'keu\transferPembayaranController@transfer');
	// Route::get('transferNoBukti/proses', 'keu\transferNoBuktiController@transfer');
	// Route::get('transferNoBukti/postingGL', 'keu\transferNoBuktiController@postingGlPenerimaanDua');


});

Route::group(['prefix'=>'acc'], function(){ 
	Route::resource('coas', 'acc\coasMstController');
	Route::resource('transAr', 'acc\transArMstController');
	Route::resource('anggaran', 'acc\anggaranMstController');
	Route::resource('perusahaan', 'acc\perushahaanMstController');
	Route::resource('tipe_jurnal', 'acc\tipeJurnalMstController');
	
	Route::get('coas/ap/cst','acc\coasMstController@_coas_ap');
	Route::get('coas/ap/pms_cst','acc\coasMstController@coas_pms_customer');
	Route::get('lovFakturPiutang','acc\fakturPiutangController@_lovFakturPiutang');
	Route::get('lovFakturHutang','acc\fakturHutangController@_lovFakturHutang');
	Route::get('coasJenis', 'acc\coasMstController@get_coas_jenis');
	Route::get('coasTipe', 'acc\coasMstController@get_coas_tipe');
});

Route::group(['prefix'=>'umum'], function(){
	Route::resource('supplier', 'umum\supplierController');
});

Route::group(['prefix'=>'sdm'], function(){
	Route::resource('pegawai', 'sdm\pegawaiMstController');
	Route::get('allPerus', 'sdm\perusahaanController@all');
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
