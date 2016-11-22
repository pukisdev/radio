<?php

namespace App\Http\Models\pms;

use Illuminate\Database\Eloquent\Model;

class pms_jenis_klien_mst extends Model
{
    //
    var $alias 				= "";//"bi_pms.";		
	protected $table		= 'pms_jenis_klien_mst';	
	protected $primaryKey 	= 'id_jenis_klien';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('id_jenis_klien', 'keterangan', 'sys_user_update', 'sys_last_update', 'sys_status_aktif');
}
