<?php

namespace App\Http\Models\sys;

use Illuminate\Database\Eloquent\Model;

class sys_status_mst extends Model
{
    //
    protected $table 		= 'sys_status_mst';
    protected $primaryKey 	= 'id_status';
    public $incrementing 	= false;
    public $timestamps		= false;
}

