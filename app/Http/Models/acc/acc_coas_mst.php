<?php
	
namespace App\Http\Models\acc;
	
use Illuminate\Database\Eloquent\Model;
	
class acc_coas_mst extends Model
{
    //
    // $alias		= "bi_keu.";		
	protected $table		= 'bi_acc.acc_coas_mst';
	protected $primaryKey 	= 'coa_id';
	public $incrementing	= false;
	public $timestamps 		= false;
	protected $fillable 	= array('coa_type', 'parent_id', 'coa_desc', 'coa_revaluation','coa_sub_acct','coa_side','coa_id','coa_name','account_id',
	 								'coa_level','coa_revaluation_current', 'region_id');
	
	/**
	 * @function customer dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function customer()
	{
	    return $this->hasMany('App\Http\Models\pms\pms_customer_mst','coa_id','coa_id');
	}
	
	/**
	 * @function supplier dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function supplier()
	{
	    return $this->hasMany('App\Http\Models\umum\umum_supplier_mst','coa_id','coa_id');
	}
	
	
	/**
	 * @function fa_penerimaan_jurnal_det dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function fa_penerimaan_jurnal_det()
	{
	    return $this->hasMany('App\Http\Models\keu\fa_penerimaan_jurnal_det','coa_id','coa_id');
	}
	
	/**
	 * @function acc_coas_jns_acc dibuat dan dikembangkan oleh rianday.
	 * @depok
	 * @return true
	 */
	public function acc_coas_jns_acc()
	{
	    return $this->belongsTo('App\Http\Models\acc\acc_coas_jns_acc','coa_type','id_jenis');
	}

}
