<?php

namespace App\Http\Models\sdm;

use Illuminate\Database\Eloquent\Model;

class sdm_pegawai_mst extends Model
{
    var $alias 				= "";//"bi_pms.";		
	protected $table		= 'sdm_pegawai_mst';	
	protected $primaryKey 	= 'nip_sys';
	public $incrementing	= false;
	public $timestamps 		= false;
	// protected $fillable 	= array('id_fp','generate_ke', 'f_customer','tgl_fp','deskripsi_fp',
	// 								'tgl_jatuh_tempo','jenis_faktur','keterangan','ttd', 'netto','netto_terbilang', 
	// 								'sys_user_update', 'sys_tgl_update', 'sys_status_aktif');

	/**
	 * @function spks_apv dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function spks_apv()
	{
	    $this->hasMany('App\Http\Models\hkm\hkm_spks_apv','apv_nip','nip_sys');
	}

}
