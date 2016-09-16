<?php

namespace App\Http\Controllers\acc;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\acc\acc_coas_mst as modelMst;

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
            $items = modelMst::whereNotNull('coa_id')->where("coa_name", "LIKE", "%".$request->get('search')."%")->orWhere("coa_id", "LIKE", "%".$request->get('search')."%")->orderBy('coa_id','asc')->paginate(5);      
        } else {
            $items = modelMst::whereNotNull('coa_id')->orderBy('coa_id','asc')->paginate(5);      
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // DB::enableQueryLog();    
        // $items = modelMst::with('customer','fp_det.pnwr')->find($request->_id);

        $items = modelMst::with(['customer', 'fp_det' => function($query){
                                    $query->where('sys_status_aktif','A'); 
                                }, 'fp_det.pnwr']
            )->find($request->_id);
    
        // dd(DB::getQueryLog());   
                
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

}
