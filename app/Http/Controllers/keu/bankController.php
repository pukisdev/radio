<?php

namespace App\Http\Controllers\KEU;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\keu\fa_bank_mst as modelMst;
use App\Http\Requests\keu\reqKeuBankMst as reqMst;

class bankController extends Controller
{
    //
	public function index(Request $request)
    {
        if($request->get('search')){
            $items = modelMst::where("nama_bank", "LIKE", "%".$request->get('search')."%")
            		 //->where("status_aktif","=","A")
            		 ->paginate(5);      
        }else{
          //$items = modelMst::where("status_aktif","=","A")->paginate(5);
          $items = modelMst::paginate(5);
        }
        // dd($items);
        return response($items);        
    }

    public function _index(){
    	return view('modules/keu/bank/tblBank', ['judul'=>'Bank']);
    }

    public function edit($id)
    {
        $hasil= modelMst::find($id);
        //dd(response($hasil));
        return response($hasil);
    }

    public function show($id)
    {
        return modelMst::find($id);
    }

    public function store(reqMst $request, modelMst $model)
    {
    	$request->merge(array(
            'no' => $this->generate_id()
        ));
        $model->create($request->all());
        return $model->find($request->no);
    }

    public function update(reqMst $request, modelMst $bank)
    {
        // dd($request->all());
        //
        //echo 'oke';
        $bank->fill($request->all())->save();
        return response($bank->find($request->NO));
    }

    public function destroy($id)
    {
    	modelMst::where((new modelMst)->getKeyName(), $id)->update(['status_aktif'=>'N']);      
    }

    private function generate_id(){
        $max_id = modelMst::max('no');
        return (!empty($max_id) ? ($max_id + 1): 1 ); 
    }
}
