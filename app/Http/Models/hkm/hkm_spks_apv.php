<?php

namespace App\Http\Models\hkm;

use Illuminate\Database\Eloquent\Model;

class hkm_spks_apv extends Model
{
    //
    protected $alias		= "";//"bi_pms.";		
	protected $table		= 'hkm_spks_apv';	
	protected $primaryKey 	= null;
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('f_spks', 'apv_nip', 'apv_status', 'apv_tgl','mandatori','keterangan',
									'sys_user_created','sys_user_updated', 'sys_tgl_created','sys_tgl_updated', 'sys_status_aktif');

	/**
	 * @function master dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function master()
	{
	    return $this->belongsTo('App\Http\Models\hkm\hkm_spks_mst','f_spks','id_spks');
	}

	/**
	 * @function  dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function pegawai()
	{
	    return $this->belongsTo('App\Http\Models\sdm\sdm_pegawai_mst','apv_nip','nip_sys');
	}


}
