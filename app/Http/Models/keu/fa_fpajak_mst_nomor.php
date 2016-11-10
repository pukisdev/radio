<?php

namespace App\Http\Models\keu;

use Illuminate\Database\Eloquent\Model;

class fa_fpajak_mst_nomor extends Model
{
    //
    protected $table 		= 'bi_keu.fa_fpajak_mst_nomor';
    protected $fillable		= array('nomor_surat_pajak', 'nomor_surat_permohonan', 'nomor_depan', 'nomor_belakang', 'nomor_belakang_max', 'tanggal', 'default_cetak', 'sys_user_update', 'sys_tgl_update', 'sys_status_aktif');

    public function kwitansi_det()
	{
	    return $this->belongsTo('App\Http\Models\keu\kwitansi_det', 'f_sk_fpajak', 'nomor_surat_pajak');
	}
}
