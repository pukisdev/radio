<?php

namespace App\Http\Models\keu;

use Illuminate\Database\Eloquent\Model;

class fa_penerimaan_mst extends Model
{
    //
    // $alias		= "bi_keu.";		
	protected $table		= 'bi_keu.fa_penerimaan_mst';	
	protected $primaryKey 	= 'no_bukti';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('no_bukti', 'tgl_terima', 'tgl_cetak', 'jenis_bukti','kode_trans','coa_id_cust','total','keterangan','terbilang',
									'coa_customer','lks', 'posting','kode_relasi', 'lock_pwk','kode_perwakilan','no_reff_pwk');


	/**
	 * @function fa_penerimaan_det dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function fa_penerimaan_det()
	{
	    return $this->hasMany('App\Http\Models\keu\fa_penerimaan_det','no_bukti','no_bukti');
	}


	/**
	 * @function fa_penermiaan_ar_det dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function fa_penerimaan_ar_det()
	{
	    return $this->hasMany('App\Http\Models\keu\fa_penerimaan_ar_det','no_bukti','no_bukti');
	}

	/**
	 * @function fa_penermiaan_ap_det dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function fa_penerimaan_ap_det()
	{
	    return $this->hasMany('App\Http\Models\keu\fa_penerimaan_ap_det','no_bukti','no_bukti');
	}

	/**
	 * @function fa_penerimaan_jurnal_det dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function fa_penerimaan_jurnal_det()
	{
	    return $this->hasMany('App\Http\Models\keu\fa_penerimaan_jurnal_det','no_bukti','no_bukti');
	}
}
