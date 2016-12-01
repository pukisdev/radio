<?php

namespace App\Http\Models\acc;

use Illuminate\Database\Eloquent\Model;

class acc_coas_jns_acc extends Model
{
    //
    protected $table		= 'bi_acc.acc_coas_jns_acc';	
	protected $primaryKey 	= 'id_jenis';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('id_jenis', 'nama_jenis');

}
