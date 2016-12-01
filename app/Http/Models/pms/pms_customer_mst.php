<?php

namespace App\Http\Models\pms;

use Illuminate\Database\Eloquent\Model;

class pms_customer_mst extends Model
{
    var $alias 				= "";//"bi_pms.";		
	protected $table		= 'pms_customer_mst';	
	protected $primaryKey 	= 'id_customer';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('id_customer', 'group_perusahaan', 'jenis_klien', 'ket_nama', 'nama_customer', 'alamat1', 'alamat2', 'kode_pos', 'kota', 'telepon', 'fax', 'contact_person', 'telp_cp', 'npwp', 'nama_npwp', 'alamat_npwp', 'no_rekening', 'jenis_bayar', 'keterangan_bayar', 'keterangan', 'coa_id', 'sys_user_update', 'sys_tgl_update', 'sys_status_aktif');


	public function pms_ket_customer_mst(){
		$this->belongsTo('App\Http\Models\pms\pms_ket_customer_mst', 'id_keterangan', 'ket_nama');	
	}

	/**
	 * @function pnwr_mst dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function pnwr_mst()
	{
	    $this->hasMany('App\Http\Models\pms\pms_pnwr_mst','f_customer','id_customer');
	}

	/**
	 * @function pnwr_mst dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function fp_mst()
	{
	    $this->hasMany('App\Http\Models\pms\pms_fp_mst');
	}


	/**
	 * @function spks dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function spks()
	{
	    $this->hasMany('App\Http\Models\hkm\hkm_spks_mst','f_customer','id_customer');
	}
}
