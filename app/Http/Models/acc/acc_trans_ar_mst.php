<?php

namespace App\Http\Models\acc;

use Illuminate\Database\Eloquent\Model;

class acc_trans_ar_mst extends Model
{
    //
    protected $table		= 'bi_acc.acc_trans_ar_mst';	
	protected $primaryKey 	= 'kode_trans';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable		= array('kode_trans', 'nama_trans');
}
