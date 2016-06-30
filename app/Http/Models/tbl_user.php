<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class tbl_user extends Model
{
 	protected $table		= 'tbl_user';	
	protected $primaryKey 	= 'uuid';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('uuid','nama', 'alamat');

}