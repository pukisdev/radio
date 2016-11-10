<?php

namespace App\Http\Models\keu;

use Illuminate\Database\Eloquent\Model;

class fa_kwitansi_iklan extends Model
{
    //
    protected $table		= 'bi_keu.fa_kwitansi_iklan';
    protected $primaryKey	= 'no_faktur_iklan';
    public $incrementing	= false;
    public $timestamps		= false;
    protected $fillable		= array(
    							'no_faktur_iklan',
    							'no_kwitansi',
    							'tgl_kwitansi',
    							'kategori',
    							'kode_area',
								'mengetahui',
								'customer',
								'cetak',
								'nama_biro',
								'ck',
								'kode_biro',
								'faktur_pajak',
								'status_posting',
								'no_order',
								'no_fpajak',
								'status_batal'
							);
}
