<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class pms_pnwr_materi extends Model
{
    //
    var $alias 				= "";//"bi_pms.";		
	protected $table		= 'pms_pnwr_materi';	
	protected $primaryKey 	= null;
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('f_pnwr','materi_tayang', 'materi_attach','realisasi_produk',
									'sys_user_update', 'sys_tgl_update', 'sys_status_aktif');


	/**
	 * @function pnwr_mst dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function pnwr_mst()
	{
	    $this->belongsTo('App\Http\Models\pms_pnwr_mst','f_pnwr','id_pnwr');
	}
}
