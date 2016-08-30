<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    // /**
    //  * The attributes that should be hidden for arrays.
    //  *
    //  * @var array
    //  */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];


    protected $table        = 'sys_user_mst';
    protected $primaryKey   = 'f_nip_sys';
    public $incrementing    = false;
    public $timestamps      = false;
    // protected $keyType      = 'string';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'f_nip_sys', 'name', 'email', 'password', 'sys_user_created', 'sys_user_updated', 'sys_tgl_created', 'sys_tgl_updated', 'sys_status_aktif',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}
