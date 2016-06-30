<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class pms_tgl_libur_mst extends Model
{
	var $alias 				= "";//"bi_pms.";		
	protected $table		= 'pms_tgl_libur_mst';	
	protected $primaryKey 	= 'id_tanggal';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('id_tanggal', 'deskripsi', 'sys_user_update', 'sys_tgl_update', 'sys_status_aktif');
    
}
