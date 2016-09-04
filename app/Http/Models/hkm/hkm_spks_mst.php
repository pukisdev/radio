<?php

namespace App\Http\Models\hkm;

use Illuminate\Database\Eloquent\Model;

class hkm_spks_mst extends Model
{
    //
    protected $alias		= "";//"bi_pms.";		
	protected $table		= 'hkm_spks_mst';	
	protected $primaryKey 	= 'id_spks';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('id_spks', 'alias_spks', 'f_customer', 'nama','tgl_awal','tgl_akhir','draft','files','keterangan',
									'sys_user_created','sys_user_updated', 'sys_tgl_created','sys_tgl_updated', 'sys_status_aktif');


	/**
	 * @function pnwr_mst dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function customer()
	{
	    return $this->belongsTo('App\Http\Models\pms\pms_customer_mst','f_customer','id_customer');
	}


	/**
	 * @function pnwr dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function pnwr()
	{
	    return $this->hasMany('App\Http\Models\pms\pms_pnwr_mst','f_spks','id_spks');
	}

	/**
	 * @function apv dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function apv()
	{
	    return $this->hasMany('App\Http\Models\hkm\hkm_spks_apv','f_spks','id_spks');
	}
}
