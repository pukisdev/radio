<?php

namespace App\Http\Controllers\acc;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\acc\acc_journal_mst as modelMst;

use DB;

class tipeJurnalMstController extends Controller
{
    public function _index(){
        return view('modules/acc/tipeJurnalMst');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->get('search')){
            $items = modelMst::where("journal_code", "LIKE", "%".$request->get('search')."%")
                    ->orWhere("journal_desc", "LIKE", "%".$request->get('search')."%")
                    ->orderBy('journal_code', 'asc')
                    ->paginate(5);      
        } else {
            $items = modelMst::orderBy('journal_code', 'asc')->paginate(5);      
        }
    
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


    private function generate_id(){
        //BM2016070086
        // $max_id = modelMst::where('no_bukti','like',$_jenis.'M'.date('Y').'07%')->max('no_bukti');
        $max_id = modelMst::where('journal_code','<>','99')->max('journal_code');
        return !empty($max_id) ? str_pad(((int)$max_id)+1,2,'0',STR_PAD_LEFT) : '01'; 
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
        $no_jurnal =  $this->generate_id();

        $request->offsetSet("journal_code", $no_jurnal);
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
        modelMst::find($id)->update($request->all());
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
