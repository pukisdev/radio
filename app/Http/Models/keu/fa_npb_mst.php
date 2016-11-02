<?php

namespace App\Http\Models\keu;

use Illuminate\Database\Eloquent\Model;

class fa_npb_mst extends Model
{
    //
    protected $table		= 'bi_keu.fa_npb_mst';
    protected $primaryKey	= 'no_pp';
    public $incrementing	= false;
    public $timestamps		= false;
    protected $fillable		= array('no_pp','keterangan','total_bayar');
}
