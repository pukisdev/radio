<?php

namespace App\Http\Models\pms;

use Illuminate\Database\Eloquent\Model;

class pms_ket_customer_mst extends Model
{
    var $alias 				= "";//"bi_pms.";		
	protected $table		= 'pms_ket_customer_mst';	
	protected $primaryKey 	= 'id_keterangan';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('id_keterangan', 'nama_keterangan', 'sys_user_update', 'sys_last_update', 'sys_status_aktif');
}
