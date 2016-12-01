<?php

namespace App\Http\Models\acc;

use Illuminate\Database\Eloquent\Model;

class acc_anggaran_mst extends Model
{
    //
	protected $table		= 'bi_acc.acc_anggaran_mst';	
	protected $primaryKey 	= 'kode_anggaran';
	public $incrementing	= false;
	public $timestamps 		= false;
    protected $fillable		= array('kode_anggaran','cost_center_id', 'kode_bagian', 'tahun', 'company_id', 'create_by', 'create_date', 'update_by', 'update_date', 'status_lock', 'jumlah_anggaran');

	/**
	 * @function anggaran_det dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function anggaran_det()
	{
	    return $this->hasMany('App\Http\Models\acc\acc_anggaran_det','kode_anggaran','kode_anggaran');
	}

}
