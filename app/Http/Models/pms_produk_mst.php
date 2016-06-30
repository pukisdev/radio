<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class pms_produk_mst extends Model
{
	var $alias 				= "";//"bi_pms.";		
	protected $table		= 'pms_produk_mst';	
	protected $primaryKey 	= 'id_produk';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('id_produk', 'nama', 'durasi', 'satuan_durasi', 'sys_user_update', 'sys_tgl_update', 'sys_status_aktif');


	/**
	 * @function tarif dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function tarif()
	{
	    return $this->hasMany('App\Http\Models\pms_produk_tarif','f_produk','id_produk');
	}
	
	/**
	 * @function pnwr_mst dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function pnwr_mst()
	{
	    return $this->hasMany('App\Http\Models\pms_pnwr_mst','f_produk','id_produk');
	}

}
