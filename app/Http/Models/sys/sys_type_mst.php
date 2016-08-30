<?php

namespace App\Http\Models\sys;

use Illuminate\Database\Eloquent\Model;

class sys_type_mst extends Model
{
    //
    protected $table 		= 'sys_type_mst';
    protected $primaryKey 	= 'id_type';
    public $incrementing 	= false;
    public $timestamps 		= false;
}
