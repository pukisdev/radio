<?php

namespace App\Http\Models\acc;

use Illuminate\Database\Eloquent\Model;

class acc_kartu_piutang extends Model
{
    //
    // $alias		= "bi_keu.";		
	protected $table		= 'bi_acc.acc_kartu_piutang';	
	// protected $primaryKey 	= 'no_faktur';
	public $incrementing	= false;
	public $timestamps 		= false;

}
