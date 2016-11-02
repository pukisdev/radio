<?php

namespace App\Http\Models\keu;

use Illuminate\Database\Eloquent\Model;

class fa_jenis_trans_mst extends Model
{
    //
    protected $table		= 'bi_keu.fa_jenis_trans_mst';
    protected $primaryKey	= 'kode_trans';
    public $incrementing	= false;
    public $timestamps		= false;
    protected $fillable		= array('kode_trans','transaksi','dk');
}
