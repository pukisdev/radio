<?php

namespace App\Http\Models\keu;

use Illuminate\Database\Eloquent\Model;

class fa_pembayaran_mst extends Model
{
    //
    protected $table		= 'bi_keu.fa_pembayaran_mst';
    protected $primaryKey	= 'no_bukti';
    public $incrementing	= false;	
    public $timestamps 		= false;
    protected $fillable		= array('no_bukti', 'tgl_cetak', 'jenis_bukti', 'kode_trans', 'no_ppb', 'terbilang', 'bagian', 'keterangan', 'total', 'tax_id', 'nota_dari',
    							'no_npum', 'status', 'lks', 'posting', 'di_customer', 'lock_pwk');

    public function fa_pembayaran_det()
	{
	    return $this->hasMany('App\Http\Models\keu\fa_pembayaran_det','no_bukti','no_bukti');
	}

	public function fa_pembayaran_bank_det()
	{
	    return $this->hasMany('App\Http\Models\keu\fa_pembayaran_bank_det','no_bukti','no_bukti');
	}

	public function fa_pembayaran_ap_det()
	{
	    return $this->hasMany('App\Http\Models\keu\fa_pembayaran_ap_det','no_bukti','no_bukti');
	}

	public function fa_pembayaran_giro_det()
	{
	    return $this->hasMany('App\Http\Models\keu\fa_pembayaran_giro_det','no_bukti','no_bukti');
	}

	public function fa_pembayaran_jurnal_det()
	{
	    return $this->hasMany('App\Http\Models\keu\fa_pembayaran_jurnal_det','no_bukti','no_bukti');
	}
}