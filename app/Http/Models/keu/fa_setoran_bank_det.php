<?php

namespace App\Http\Models\keu;

use Illuminate\Database\Eloquent\Model;

class fa_setoran_bank_det extends Model
{
    //
    protected $table		= 'bi_keu.fa_setoran_bank_det';	
    public $timestamps 		= false;
    protected $fillable		= array(
    								'no_bukti',
    								'no_bank',
    								'no_seri',
    								'jumlah',
    								'jatuh_tempo'
    							);

    public function fa_penerimaan_det(){
         return $this->belongsTo('App\Http\Models\keu\fa_penerimaan_det','no_seri','no_giro');
    }
}
