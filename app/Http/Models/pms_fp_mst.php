<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class pms_fp_mst extends Model
{
    var $alias 				= "";//"bi_pms.";		
	protected $table		= 'pms_fp_mst';	
	protected $primaryKey 	= 'id_fp';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('id_fp','generate_ke', 'f_customer','tgl_fp','deskripsi_fp',
									'tgl_jatuh_tempo','jenis_faktur','keterangan','ttd', 'netto','netto_terbilang', 
									'sys_user_update', 'sys_tgl_update', 'sys_status_aktif');


	/**
	 * @function fp_det dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function fp_det()
	{
	    return $this->hasMany('App\Http\Models\pms_fp_det','f_fp','id_fp');
	}

	/**
	 * @function customer_mst dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function customer()
	{
	    return $this->belongsTo('App\Http\Models\pms_customer_mst','f_customer','id_customer');
	}

	
}
