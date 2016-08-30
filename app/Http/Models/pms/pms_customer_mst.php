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
	protected $fillable 	= array('id_customer','nama_customer', 
									'sys_user_update', 'sys_tgl_update', 'sys_status_aktif');


	/**
	 * @function pnwr_mst dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function pnwr_mst()
	{
	    return $this->hasMany('App\Http\Models\pms\pms_pnwr_mst','f_customer','id_customer');
	}

	/**
	 * @function pnwr_mst dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function fp_mst()
	{
	    return $this->hasMany('App\Http\Models\pms\pms_fp_mst');
	}


	/**
	 * @function spks dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function spks()
	{
	    return $this->hasMany('App\Http\Models\hkm\hkm_spks_mst','f_customer','id_customer');
	}
}
