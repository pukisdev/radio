<?php

namespace App\Http\Models\sys;

use Illuminate\Database\Eloquent\Model;

class sys_app_mst extends Model
{
    //
    protected $table = 'sys_app_mst';
    protected $primaryKey = 'id_app';
    public $incrementing = false;

    /**
     * @function module dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function module()
    {
	    return $this->belongsTo('App\Http\Models\sys\sys_module_mst','f_module','id_module');        
    }

    /**
     * @function type dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function type()
    {
        return $this->belongsTo('App\Http\Models\sys\sys_type_mst','f_type','id_type');        
    }

    /**
     * @function akses dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function akses()
    {
        return $this->hasMany('App\Http\Models\sys\sys_user_akses_det','f_app','id_app');        
    }


}
