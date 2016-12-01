<?php

namespace App\Http\Controllers\acc;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\acc\acc_trans_ar_mst as modelMst;
use Carbon;
use DB;
use Terbilang;

class transArMstController extends Controller
{
    
    public function _index(){
        return view('modules/acc/ar/transArMst');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query = modelMst::orderBy('kode_trans','asc');
        if($request->get('search')){
            $query->where("kode_trans", "LIKE", "%".$request->get('search')."%")->orWhere("nama_trans", "LIKE", "%".$request->get('search')."%");      
        }
           $items = $query->paginate(5);
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
        modelMst::create($request->all());

        //$query = modelMst::orderBy('kode_trans','asc');

        return $this->_index();
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
        $items = modelMst::find($id);
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
        //
        //DB::enableQueryLog();
        modelMst::find($id)->update($request->all());
        //dd(DB::getQueryLog());
            
        //dd($request->all());

        return $this->_index();
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
}
