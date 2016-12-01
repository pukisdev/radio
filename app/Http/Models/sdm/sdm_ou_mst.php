<?php

namespace App\Http\Models\sdm;

use Illuminate\Database\Eloquent\Model;

class sdm_ou_mst extends Model
{
    var $alias 				= "";//"bi_pms.";		
	protected $table		= 'sdm_ou_mst';	
	protected $primaryKey 	= 'id_ou';
	public $incrementing	= false;
	public $timestamps 		= false;

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
