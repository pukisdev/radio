<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class pms_fp_det extends Model
{
    var $alias 				= "";//"bi_pms.";		
	protected $table		= 'pms_fp_det';	
	protected $primaryKey 	= null;
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('f_fp','f_pnwr', 'total_biaya','nilai_biaya_persen','nilai_biaya',
									'nilai_potongan_persen','nilai_potongan','nilai_hpp','nilai_ppn', 'nilai_akhir', 
									'sys_user_update', 'sys_tgl_update', 'sys_status_aktif');


	/**
	 * @function fp_mst dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function fp_mst()
	{
	    return $this->belongsTo('App\Http\Models\pms_produk_mst','f_fp','id_fp');
	}

	/**
	 * @function pnwr dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function pnwr()
	{
	    return $this->belongsTo('App\Http\Models\pms_pnwr_mst','f_pnwr','id_pnwr');
	}


}
