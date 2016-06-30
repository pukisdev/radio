<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class pms_pnwr_spk extends Model
{
    //
    var $alias 				= "";//"bi_pms.";		
	protected $table		= 'pms_pnwr_spk';	
	protected $primaryKey 	= 'id_spk';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('id_spk', 'f_pnwr','pihak_pertama', 'jabatan_pihak_pertama',
									'pihak_kedua','jabatan_pihak_kedua', 'tgl_spk'
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
