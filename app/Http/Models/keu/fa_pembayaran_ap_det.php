<?php

namespace App\Http\Models\keu;

use Illuminate\Database\Eloquent\Model;

class fa_pembayaran_ap_det extends Model
{
    //
    protected $table 		= 'bi_keu.fa_pembayaran_ap_det';
    protected $fillable		= array('no_bukti', 'coa_id', 'no_invoice', 'currency_id', 'keterangan', 'nilai_potong', 'nilai_bayar', 'po_id');

    public function fa_pembayaran_mst()
	{
	    return $this->belongsTo('App\Http\Models\keu\fa_pembayaran_mst','no_bukti','no_bukti');
	}
}
