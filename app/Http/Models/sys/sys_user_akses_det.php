<?php

namespace App\Http\Models\sys;

use Illuminate\Database\Eloquent\Model;

class sys_user_akses_det extends Model
{
    //
    protected $table = 'sys_user_akses_det';
    protected $primaryKey = 'null';
    public $incrementing = false;

    /**
     * @function module dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function app()
    {
	    return $this->belongsTo('App\Http\Models\sys\sys_app_mst','f_app','id_app');        
    }

    /**
     * @function type dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    // public function type()
    // {
	   //  return $this->belongsTo('App\Http\Models\sys\sys_type_mst','f_type','id_type');        
    // }

}
