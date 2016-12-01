<?php

namespace App\Http\Models\acc;

use Illuminate\Database\Eloquent\Model;

class acc_anggaran_det extends Model
{
    //
	protected $table		= 'bi_acc.acc_anggaran_det';	
	// protected $primaryKey 	= 'kode_anggaran';

	/**
	 * @function anggaran_mst dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function anggaran_mst()
	{
	    return $this->belongsTo('App\Http\Models\acc\acc_anggaran_mst','kode_anggaran','kode_anggaran');
	}

}
