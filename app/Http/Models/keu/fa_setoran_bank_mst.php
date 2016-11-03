<?php

namespace App\Http\Models\keu;

use Illuminate\Database\Eloquent\Model;

class fa_setoran_bank_mst extends Model
{
    //
    protected $table		= 'bi_keu.fa_setoran_bank_mst';
    protected $primaryKey	= 'no_bukti';
    public $incrementing	= false;	
    public $timestamps 		= false;
    protected $fillable		= array(
    								'no_bukti',
    								'tgl_cetak',
    								'from_periode',
    								'to_periode',
    								'no_bank',
    								'terbilang',
    								'kelompok',
    								'jumlah',
    								'lks',
    								'keterangan',
    								'posting'
    							);

    public function fa_bank_mst(){
        return $this->belongsTo('App\Http\Models\keu\fa_bank_mst','no_bank','no');   
    }

	public function fa_setoran_bank_det(){
		 return $this->hasMany('App\Http\Models\keu\fa_setoran_bank_det','no_bukti','no_bukti');
	}

	public function fa_setoran_bank_jurnal_det()
	{
	    return $this->hasMany('App\Http\Models\keu\fa_setoran_bank_jurnal_det','no_bukti','no_bukti');
	}

}
