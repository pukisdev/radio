<?php

namespace App\Http\Models\acc;

use Illuminate\Database\Eloquent\Model;

class acc_coas_mst extends Model
{
    //
    // $alias		= "bi_keu.";		
	protected $table		= 'bi_acc.acc_coas_mst';	
	protected $primaryKey 	= 'coa_id';
	public $incrementing	= false;
	public $timestamps 		= false;
	// protected $fillable 	= array('no_bukti', 'tgl_terima', 'tgl_cetak', 'jenis_bukti','kode_trans','coa_id_cust','total','keterangan','terbilang',
	// 								'coa_customer','lks', 'posting','kode_relasi', 'lock_pwk','kode_perwakilan','no_reff_pwk');

	/**
	 * @function customer dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function customer()
	{
	    return $this->hasMany('App\Http\Models\pms\pms_customer_mst','coa_id','coa_id');
	}

	/**
	 * @function supplier dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function supplier()
	{
	    return $this->hasMany('App\Http\Models\umum\umum_supplier_mst','coa_id','coa_id');
	}


	/**
	 * @function fa_penerimaan_jurnal_det dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function fa_penerimaan_jurnal_det()
	{
	    return $this->hasMany('App\Http\Models\keu\fa_penerimaan_jurnal_det','coa_id','coa_id');
	}


}
