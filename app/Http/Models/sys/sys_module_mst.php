<?php

namespace App\Http\Models\sys;

use Illuminate\Database\Eloquent\Model;

class sys_module_mst extends Model
{
    //
    protected $table = 'sys_module_mst';
    protected $primaryKey = 'id_module';
    public $incrementing = false;


    /**
     * @function app dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function app()
    {
	    return $this->hasMany('App\Http\Models\sys\sys_app_mst','f_module','id_module');        
    }

}
