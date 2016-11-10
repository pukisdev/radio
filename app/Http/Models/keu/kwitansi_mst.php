<?php

namespace App\Http\Models\keu;

use Illuminate\Database\Eloquent\Model;

class kwitansi_mst extends Model
{
    //
    protected $table		= 'bi_keu.kwitansi_mst';
    protected $primaryKey	= 'no_kwitansi';
    public $incrementing	= false;	
    public $timestamps 		= false;
    protected $fillable		= array(
    							'no_kwitansi', 
    							'jenis',
    							'tgl_kwitansi',
    							'tgl_jatuh_tempo',
    							'kategori',
    							'deskripsi',
    							'nilai_kwitansi',
    							'terbilang',
    							'mengetahui',
    							'kode_customer',
    							'nama_customer',
    							'cetak',
    							'status_posting',
    							'sys_user_update',
    							'sys_tgl_update',
    							'sys_status_aktif',
    							'no_kwitansi_lama',
    							'alamat_kirim'
    							);
    
    public function kwitansi_det()
	{
	    return $this->hasMany('App\Http\Models\keu\kwitansi_det','f_kwitansi','no_kwitansi');
	}

    public function sdm_pegawai_mst()
    {
        return $this->hasMany('App\Http\Models\sdm\sdm_pegawai_mst', 'nip_sys', 'mengetahui');
    }
}
