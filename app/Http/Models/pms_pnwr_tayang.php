<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class pms_pnwr_tayang extends Model
{
    //
    var $alias 				= "";//"bi_pms.";		
	protected $table		= 'pms_pnwr_tayang';	
	protected $primaryKey 	= null;
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('f_pnwr','tayang_tgl', 'tayang_jam','tayang_realisasi',
									'sys_user_update', 'sys_tgl_update', 'sys_status_aktif');


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
