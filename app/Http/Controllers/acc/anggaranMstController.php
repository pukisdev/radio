<?php

namespace App\Http\Controllers\acc;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\acc\acc_anggaran_mst as modelMst;
use App\Http\Models\acc\acc_anggaran_det as modelDet;

use Carbon;
use DB;

class anggaranMstController extends Controller
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
            // $items = DB::table('bi_acc.acc_anggaran_mst aa')
            $items = modelMst::with('anggaran_det')
                    ->leftJoin('sdm_ou_mst bb','acc_anggaran_mst.kode_bagian','=','id_ou')
                    // ->select(DB::RAW('acc_anggaran_mst.*, acc_anggaran_det.*, nama_ou'))
                    ->where("nama_ou", "LIKE", "%".$request->get('search')."%")
                    ->orWhere("kode_bagian", "LIKE", "%".$request->get('search')."%")
                    ->orWhere("kode_anggaran", "LIKE", "%".$request->get('search')."%")
                    ->orderBy('tahun','nama_ou')->paginate(5);      
        } else {
            // $items = DB::table('bi_acc.acc_anggaran_mst aa')
            $items = modelMst::with('anggaran_det')
                    ->leftJoin('sdm_ou_mst bb','acc_anggaran_mst.kode_bagian','=','id_ou')
                    // ->select(DB::RAW('acc_anggaran_mst.*, acc_anggaran_det.*, nama_ou'))
                    // ->select('modelMst.*', 'anggaran_det.*', 'nama_ou')
                    ->orderBy('tahun','nama_ou')->paginate(5);      
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
        dd($request->all());
        $id = $this->generate_id();//$request->kode_anggaran; 
        modelMst::find($id)->update($request->except(['kode_anggaran','nama_ou','anggaran_det']));

        modelDet::where('kode_anggaran', $id)->delete();

        if($request->anggaran_det){
            $anggaran_det  = $request->anggaran_det;
            foreach ($anggaran_det as $key => $value) {
                unset($anggaran_det[$key]['$$hashKey']);
            }
            modelDet::insert($anggaran_det);
        }
        
        $param = new Request();
        $param->offsetSet('_id', $id);    
        return $this->edit($param, $id);
        
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        // DB::enableQueryLog();
        $items = modelMst::with('anggaran_det')
                    ->leftJoin('sdm_ou_mst bb','acc_anggaran_mst.kode_bagian','=','id_ou')
                    ->select('acc_anggaran_mst.*', 'nama_ou')
                    ->find($request->_id);
    
        // dd(DB::getQueryLog());   
                
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
        // dd($request->all());

        // DB::enableQueryLog();
        // dd(DB::getQueryLog());
        $id = $request->kode_anggaran; 
        modelMst::find($id)->update($request->except(['kode_anggaran','nama_ou','anggaran_det']));

        modelDet::where('kode_anggaran', $id)->delete();

        if($request->anggaran_det){
            $anggaran_det  = $request->anggaran_det;
            foreach ($anggaran_det as $key => $value) {
                unset($anggaran_det[$key]['$$hashKey']);
            }
            modelDet::insert($anggaran_det);
        }
        
        $param = new Request();
        $param->offsetSet('_id', $id);    
        return $this->edit($param, $id);
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
        return view('modules/acc/anggaran');        
    }

    /**
     * @function generate_id dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return id
     */
    private function generate_id(){
        $max_id = modelMst::where('kode_anggaran','like','AGR/'.date('Y/m').'/%')->max('id_fp');
        return 'AGR/'.date('Y/m').'/'.(!empty($max_id) ? str_pad(((int)substr($max_id, strpos($max_id,'.')+1)+1),2,'0',STR_PAD_LEFT) : '01'); 
    }
}
