<?php

namespace App\Http\Models\acc;

use Illuminate\Database\Eloquent\Model;

class acc_coas_tipe_acc extends Model
{
    //
    protected $table		= 'bi_acc.acc_coas_tipe_acc';	
	protected $primaryKey 	= 'id_tipe';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('id_tipe', 'nama_tipe');

}
