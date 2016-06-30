<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class pms_produk_tarif extends Model
{
    //
	var $alias 				= "";//"bi_pms.";		
	protected $table		= 'pms_produk_tarif';	
	protected $primaryKey 	= 'id_tarif';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('id_tarif', 'f_produk', 'harga', 'satuan_durasi', 'sys_user_update', 'sys_tgl_update', 'sys_status_aktif');


	/**
	 * @function produk dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function produk()
	{
	    return $this->belongsTo('App\Http\Models\pms_produk_mst','f_produk','id_produk');
	}
}
