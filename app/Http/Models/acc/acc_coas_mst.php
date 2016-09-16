<?php

namespace App\Http\Models\acc;

use Illuminate\Database\Eloquent\Model;

class acc_coas_mst extends Model
{
    //
    // $alias		= "bi_keu.";		
	protected $table		= 'bi_acc.acc_coas_mst';	
	protected $primaryKey 	= 'coa_id';
	public $incrementing	= false;
	public $timestamps 		= false;
	// protected $fillable 	= array('no_bukti', 'tgl_terima', 'tgl_cetak', 'jenis_bukti','kode_trans','coa_id_cust','total','keterangan','terbilang',
	// 								'coa_customer','lks', 'posting','kode_relasi', 'lock_pwk','kode_perwakilan','no_reff_pwk');

}
