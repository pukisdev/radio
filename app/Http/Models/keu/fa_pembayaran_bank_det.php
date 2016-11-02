<?php

namespace App\Http\Models\keu;

use Illuminate\Database\Eloquent\Model;

class fa_pembayaran_bank_det extends Model
{
    //
    protected $table 		= 'bi_keu.fa_pembayaran_bank_det';
    protected $fillable		= array('no_bukti', 'no_bank', 'coa_id', 'tgl_transfer', 'nomor', 'nilai', 'keterangan', 'account_bank', 'jenis_trans'); 

    public function fa_pembayaran_mst()
	{
	    return $this->belongsTo('App\Http\Models\keu\fa_pembayaran_mst','no_bukti','no_bukti');
	}

	public function fa_bank_mst()
	{
	    return $this->belongsTo('App\Http\Models\keu\fa_bank_mst','no_bank','no');
	}

	public function fa_jenis_trans_mst()
	{
	    return $this->belongsTo('App\Http\Models\keu\fa_jenis_trans_mst','jenis_trans','kode_trans');
	}
}
