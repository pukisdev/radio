<?php

namespace App\Http\Controllers\keu;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\keu\fa_fpajak_mst_nomor as ModelMst;

use Carbon;
use DB;
use Validator;

class nomorFPajakController extends Controller
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
            $items = modelMst::where("no_bukti", "LIKE", "%".$request->get('search')."%")
                     //->where("status_aktif","=","A")
                     ->orderBy('tanggal','desc')->paginate(5);      
        }else{
          //$items = modelMst::where("status_aktif","=","A")->paginate(5);
          $items = modelMst::orderBy('tanggal','desc')->paginate(5);
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
        //
        //DB::enableQueryLog();
        // dd($request->all());
        $tanggal      = \DateTime::createFromFormat('D M d Y H:i:s e+', $request->tanggal);

        $request->offsetSet("tanggal", $tanggal);
        modelMst::create($request->all());
        
        //dd(DB::getQueryLog());
        //dd($request->all());
        return modelMst::find($request->nomor_surat_pajak);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        // dd($request->all());
        // DB::enableQueryLog();
        //
        $validation = Validator::make($request->all(),['nomor_surat_pajak'=>'required']);

        if($validation->fails()) return $validation->errors();

        $items = modelMst::find($request->nomor_surat_pajak);   
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
        // DB::enableQueryLog();
        // dd($request->all());
        $tanggal = \DateTime::createFromFormat('D M d Y H:i:s e+', $request->tanggal);

        $request->offsetSet("tanggal", $tanggal);
        $request->offsetSet("status", !empty($request->status) ? $request->status : 'N');

        modelMst::where('nomor_surat_pajak',$request->nomor_surat_pajak)->update($request->except(['nomor_surat_pajak']));
        // dd(DB::getQueryLog());
        if($request->status == 'Y') modelMst::whereNotIn('nomor_surat_pajak',[$request->nomor_surat_pajak])->update(['status'=>'N']);
        
        return modelMst::find($request->nomor_surat_pajak);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(),['nomor_surat_pajak'=>'required']);

        if($validation->fails()) return $validation->errors();
        modelMst::where('nomor_surat_pajak', $request->nomor_surat_pajak)->delete();
    }

    public function _index(){
        return view('modules.keu.nomorFPajak');
    }

}
