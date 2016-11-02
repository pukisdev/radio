<?php

namespace App\Http\Models\keu;

use Illuminate\Database\Eloquent\Model;

class acc_cost_center extends Model
{
    //
    protected $table		= 'bi_acc.acc_cost_center';
    protected $primaryKey	= 'cost_id';
    public $incrementing	= false;
    public $timestamps		= false;
    protected $fillable		= array('cost_id','cost_jenis','cost_keterangan');
}
