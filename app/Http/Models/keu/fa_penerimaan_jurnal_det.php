<?php

namespace App\Http\Models\keu;

use Illuminate\Database\Eloquent\Model;

class fa_penerimaan_jurnal_det extends Model
{
    //
    // protected $alias		= "bi_keu.";		
	protected $table		= 'bi_keu.fa_penerimaan_jurnal_det';	
	// protected $primaryKey 	= 'no_bukti';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('no_bukti', 'coa_id', 'currency_id', 'keterangan', 'debet', 'kredit', 'costcenter');


	/**
	 * @function fa_penerimaan_mst dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function fa_penerimaan_mst()
	{
	    return $this->belongsTo('App\Http\Models\keu\fa_penerimaan_mst','no_bukti','no_bukti');
	}

}
