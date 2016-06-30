<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class pms_pnwr_mst extends Model
{
    //
    var $alias 				= "";//"bi_pms.";		
	protected $table		= 'pms_pnwr_mst';	
	protected $primaryKey 	= 'id_pnwr';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('id_pnwr','no_po_customer', 'f_customer','judul_iklan','kepada', 'f_ae',
									'f_produk','tarif','tgl_penawaran','durasi', 'periode', 'tgl_awal', 'tgl_akhir',//'jml_periode', 'satuan_periode', 
									'frekuensi', 'total_tayang', 'jenis_bayar', 'tarif_normal',
									'tarif_diskon', 'tarif_potongan', 'tarif_hpp','tarif_ppn','tarif_total',
									// 'pnwr_harga_dasar','pnwr_diskon','pnwr_potongan', 'pnwr_total',
									'pnwr_hpp','pnwr_ppn','pnwr_total','pnwr_status','keterangan',
									'sys_user_update', 'sys_tgl_update', 'sys_status_aktif');


	/**
	 * @function customer_mst dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function customer()
	{
	    return $this->belongsTo('App\Http\Models\pms_customer_mst','f_customer','id_customer');
	}


	/**
	 * @function produk_mst dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function produk()
	{
	    return $this->belongsTo('App\Http\Models\pms_produk_mst','f_produk','id_produk');
	}

	/**
	 * @function fp_det dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function faktur()
	{
	    return $this->hasMany('App\Http\Models\pms_fp_det','f_pnwr','id_pnwr');
	}

	/**
	 * @function tayang dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function tayang()
	{
	    return $this->hasMany('App\Http\Models\pms_pnwr_tayang','f_pnwr','id_pnwr');
	}


	/**
	 * @function tarif_mst dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	// public function tarif_mst()
	// {
	//     $this->belongsTo('App\Http\Models\pms_tarif_mst','f_tarif','id_tarif');
	// }
}
