<?php

namespace App\Http\Models\acc;

use Illuminate\Database\Eloquent\Model;

class acc_faktur_piutang extends Model
{
    //
    // $alias		= "bi_keu.";		
	protected $table		= 'bi_acc.acc_faktur_piutang';	
	protected $primaryKey 	= 'no_faktur';
	public $incrementing	= false;
	public $timestamps 		= false;


}
