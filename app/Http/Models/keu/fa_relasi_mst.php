<?php

namespace App\Http\Models\keu;

use Illuminate\Database\Eloquent\Model;

class fa_relasi_mst extends Model
{
    //
    protected $table		= 'bi_keu.fa_relasi_mst';	
	protected $primaryKey 	= 'kode_relasi';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('kode_relasi','nama','alamat','telp','coa_id','npwp','bagian');
}
