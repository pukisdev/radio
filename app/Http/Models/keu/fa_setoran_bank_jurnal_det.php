<?php

namespace App\Http\Models\keu;

use Illuminate\Database\Eloquent\Model;

class fa_setoran_bank_jurnal_det extends Model
{
    //
    protected $table		= 'bi_keu.fa_setoran_bank_jurnal_det';
    public $incrementing	= false;	
    protected $fillable		= array(
    								'no_bukti',
    								'coa_id',
    								'keterangan',
    								'debet',
    								'kredit',
    								'currency_id',
    								'costcenter'
    							);

    public function acc_coas_mst()
    {
        return $this->belongsTo('App\Http\Models\acc\acc_coas_mst','coa_id','coa_id');
    }

    public function acc_cost_center()
    {
        return $this->belongsTo('App\Http\Models\keu\acc_cost_center','costcenter','cost_id');
    }
}
