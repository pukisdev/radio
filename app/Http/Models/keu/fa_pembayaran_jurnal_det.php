<?php

namespace App\Http\Models\keu;

use Illuminate\Database\Eloquent\Model;

class fa_pembayaran_jurnal_det extends Model
{
    //
    protected $table		= 'bi_keu.fa_pembayaran_jurnal_det';
    protected $fillable		= array('no_bukti', 'coa_id', 'currency_id', 'keterangan', 'debet', 'kredit', 'dept', 'costcenter');

    public function fa_pembayaran_mst()
	{
	    return $this->belongsTo('App\Http\Models\keu\fa_pembayaran_mst','no_bukti','no_bukti');
	}

	public function acc_coas_mst()
	{
	    return $this->belongsTo('App\Http\Models\acc\acc_coas_mst','coa_id','coa_id');
	}

	public function acc_cost_center()
	{
	    return $this->belongsTo('App\Http\Models\keu\acc_cost_center','costcenter','cost_id');
	}
}
