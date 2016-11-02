<?php

namespace App\Http\Controllers\KEU;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\keu\acc_cost_center as modelMst;
use App\Http\Requests\keu\reqKeuCostCenter as reqMst;

class costCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function _index(){
        return view('modules/keu/cost_center/tblCostCenter', ['judul'=>'Cost Center']);
    }

    public function index(Request $request)
    {
        //
        if($request->get('search')){
            $items = modelMst::where("cost_keterangan", "LIKE", "%".$request->get('search')."%")
                     //->where("status_aktif","=","A")
                     ->paginate(5);      
        }else{
          //$items = modelMst::where("status_aktif","=","A")->paginate(5);
          $items = modelMst::paginate(5);
        }
        //dd($items);
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
    public function store(reqMst $request, modelMst $model)
    {
        $request->merge(array(
            'cost_id' => $this->generate_id($request->cost_jenis)
        ));
        $model->create($request->all());
        return $model->find($request->no);
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
    public function edit($id)
    {
        //
        $hasil= modelMst::find($id);
        //dd(response($hasil));
        return response($hasil);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqMst $request, modelMst $cost_center)
    {
        // dd($request->all());
        //
        //echo 'oke';
        $cost_center->fill($request->all())->save();
        return response($cost_center->find($request->cost_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        modelMst::where((new modelMst)->getKeyName(), $id)->update(['status_aktif'=>'N']);
    }

    private function generate_id($jenis){
        $max_jenis = modelMst::where('cost_jenis', $jenis)->count();
        return (!empty($max_jenis) ? $jenis.'.'.str_pad(($max_jenis + 1), 2, '0', STR_PAD_LEFT) : $jenis.'.01'); 
    }
}
