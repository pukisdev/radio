<?php

namespace App\Http\Models\acc;

use Illuminate\Database\Eloquent\Model;

class acc_journal_mst extends Model
{
    //
    protected $table		= 'bi_acc.acc_journal_mst';	
	protected $primaryKey 	= 'journal_code';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable		= array('journal_code', 'journal_desc');
}
