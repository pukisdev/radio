<?php

namespace App\Http\Models\umum;

use Illuminate\Database\Eloquent\Model;

class umum_supplier_mst extends Model
{
    var $alias 				= "";//"bi_pms.";		
	protected $table		= 'bi_umum.umum_supplier_mst';	
	protected $primaryKey 	= 'id_supplier';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('id_supplier','nama_supplier', 'coa_id',
									'sys_user_update', 'sys_tgl_update', 'sys_status_aktif');

	/**
	 * @function coa dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function coa()
	{
	    return $this->belongsTo('App\Http\Models\acc\acc_coas_mst','coa_id','coa_id');
	}
}
