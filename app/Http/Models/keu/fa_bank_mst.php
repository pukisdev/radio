<?php

namespace App\Http\Models\keu;

use Illuminate\Database\Eloquent\Model;

class fa_bank_mst extends Model
{
    //
    // $alias		= "bi_keu.";		
	protected $table		= 'bi_keu.fa_bank_mst';	
	protected $primaryKey 	= 'no';
	public $incrementing	= false;
	public $timestamps 		= false;
	// protected $fillable 	= array('no_bukti', 'tgl_terima', 'tgl_cetak', 'jenis_bukti','kode_trans','coa_id_cust','total','keterangan','terbilang',
	// 								'coa_customer','lks', 'posting','kode_relasi', 'lock_pwk','kode_perwakilan','no_reff_pwk');

}
