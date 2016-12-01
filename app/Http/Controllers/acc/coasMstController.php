<?php

namespace App\Http\Controllers\acc;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\acc\acc_coas_mst as modelMst;
use App\Http\Models\acc\acc_coas_jns_acc as modelJns;
use App\Http\Models\acc\acc_coas_tipe_acc as modelTipe;

use DB;

// use Carbon;
// use DB;

class coasMstController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 
        if($request->get('search')){
            $items = modelMst::whereNotNull('coa_id')
                    ->leftJoin('bi_sdm.sdm_perusahaan_view', 'kode', '=', 'region_id')
                    ->where("coa_name", "LIKE", "%".$request->get('search')."%")
                    ->orWhere("coa_id", "LIKE", "%".$request->get('search')."%")->orWhere("coa_desc", "LIKE", "%".$request->get('search')."%")
                    ->orderBy('coa_id','asc')
                    ->paginate(5);      
        } else {
            $items = modelMst::leftJoin('bi_sdm.sdm_perusahaan_view', 'kode', '=', 'region_id')
                        ->whereNotNull('coa_id')
                        ->orderBy('coa_id','asc')
                        ->paginate(5);      
        }
        // dd($items);
        return response($items);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coa_id = $request->parent_id . '.' . $request->account_id;
        
        $request->offsetSet("coa_id", $coa_id);

        $request->offsetSet("coa_sub_acct", ($request->coa_sub_acct == true) ? '1' : null);
        $request->offsetSet("coa_revaluation", ($request->coa_revaluation == true) ? '1' : null);
        $request->offsetSet("coa_revaluation_current", ($request->coa_revaluation_current == true) ? '1' : null);

        //dd($request->all());
        
        modelMst::create($request->all());

        return $this->edit($coa_id); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //DB::enableQueryLog();    
        // $items = modelMst::with('customer','fp_det.pnwr')->find($request->_id);

        $items = modelMst::select('*','nama')->leftJoin('bi_sdm.sdm_perusahaan_view', 'kode', '=', 'region_id')->find($id);
    
        //dd(DB::getQueryLog());   
                
        // dd($items->fp_det);
        return response($items);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //$items = modelMst::find($id);
        $items = modelMst::leftJoin('bi_sdm.sdm_perusahaan_view', 'kode', '=', 'region_id')->find($id);
        return response($items);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        //DB::enableQueryLog();
        
        //dd($request->coa_sub_acct);
        //var_dump($request->coa_sub_acct);

        $request->offsetSet("coa_sub_acct", ($request->coa_sub_acct == 'true') ? '1' : '');
        $request->offsetSet("coa_revaluation", ($request->coa_revaluation == 'true') ? '1' : '');
        $request->offsetSet("coa_revaluation_current", ($request->coa_revaluation_current == 'true') ? '1' : '');
        //dd($request->all());
        modelMst::find($id)->update($request->all());
        //dd(DB::getQueryLog());

        return $this->edit($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

     /**
     * @function generate_id dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return id
     */
    public function _index(){
        return view('modules/acc/coas/coasMst');
    }

    /**
     * @function generate_id dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return id
     */
    private function generate_id(){
        // $max_id = modelMst::where('id_fp','like','FP'.date('Y').'%')->max('id_fp');
        // return 'FP'.date('Y').'.'.(!empty($max_id) ? str_pad(((int)substr($max_id, strpos($max_id,'.')+1)+1),5,'0',STR_PAD_LEFT) : '00001'); 
    }

    public function coas_pms_customer(Request $request){
        if($request->get('search')){
            $items = modelMst::with('customer')
                    ->whereNotNull('coa_id')
                    ->where("coa_name", "LIKE", "%".$request->get('search')."%")
                    //->orWhere("coa_id", "LIKE", "%".$request->get('search')."%")
                    ->where('coa_id', 'like','2.1.01.0_.%')
                    ->orderBy('coa_id','asc')
                    ->paginate(5);      
        } else {
            $items = modelMst::with('customer')
                    ->whereNotNull('coa_id')
                    ->where('coa_id', 'like','2.1.01.0_.%')
                    ->orderBy('coa_id','asc')
                    ->paginate(5);      
        }
        // dd($items);
        return response($items);   
    }

    public function get_coas_jenis(){
        $items = modelTipe::get();
        return response($items);   
    }

    public function get_coas_tipe(){
        $items = modelJns::get();
        return response($items);
    }

}
