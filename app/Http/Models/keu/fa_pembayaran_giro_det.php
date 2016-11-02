<?php

namespace App\Http\Models\keu;

use Illuminate\Database\Eloquent\Model;

class fa_pembayaran_giro_det extends Model
{
    //
    protected $table 		= 'bi_keu.fa_pembayaran_giro_det';
    protected $fillable		= array('no_bukti','no_giro', 'coa_id', 'jth_tempo', 'nilai', 'keterangan', 'dari_account');

    public function fa_pembayaran_mst()
	{
	    return $this->belongsTo('App\Http\Models\keu\fa_pembayaran_mst','no_bukti','no_bukti');
	}
}
