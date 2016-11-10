<?php

namespace App\Http\Models\keu;

use Illuminate\Database\Eloquent\Model;

class kwitansi_det extends Model
{
    //
    protected $table		= 'bi_keu.kwitansi_det';
    public $incrementing	= false;	
    public $timestamps 		= false;
    protected $fillable		= array(
    								'f_kwitansi',
    								'f_fp',
    								'depan_fpajak',
    								'no_fpajak',
    								'cetak_no_fpajak',
    								'f_sk_fpajak',
    								'nilai_faktur',
    								'sys_user_update',
    								'sys_tgl_update',
    								'sys_status_aktif',
    								'jenis_fpajak'
    							);

   	public function pms_fp_mst()
	{
	    return $this->belongsTo('App\Http\Models\pms\pms_fp_mst','f_fp','id_fp');
	}

    public function fa_fpajak_mst_nomor(){
        return $this->hasMany('App\Http\Models\keu\kwitansi_det', 'nomor_surat_pajak', 'f_sk_fpajak');
    }
}
