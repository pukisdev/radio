<?php

namespace App\Http\Controllers\PMS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\pms_pnwr_tayang as modelMst;
use App\Http\Requests\reqPmsPnwrTayang as reqMst;
use Carbon;
use DB;

class pnwrTayangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return false;
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
    // public function store(Request $request)
    public function store(Request $request, modelMst $model)
    {
        // dd($request->all());
        $f_pnwr = $request->f_pnwr;
        $request->offsetUnset("f_pnwr");
        $input = $request->all();
        // dd($input[0]['tayang_tgl']);

        foreach ($input as $key => $value) {
            // dd($value['tayang_tgl']);
            $insert[] = array(
                            'f_pnwr'        => $f_pnwr, //$value['f_pwnr'],
                            'tayang_tgl'    => Carbon::parse($value['tayang_tgl']),
                            'tayang_jam'    => implode(",", $value['tayang_jam']),
                            'sys_user_update' => 'Admin'
                        );
        }


        $model->where('f_pnwr',$f_pnwr)->whereNull('tayang_realisasi')->update(['sys_status_aktif'=>'N']);        
        // $model->where('f_pnwr',$f_pnwr)->update(['sys_status_aktif'=>'N']);        
        
        $model->insert($insert);
        // $request->merge(array(
        //     'id_pnwr' => $this->generate_id(),
        //     'sys_user_update' => 'ADMIN',
        // ));
        // $this->show($request, $f_pnwr);
        // dd($insert);
        // dd($request->all());   
        // dd($return);
        $hasil = $this->show($request, $f_pnwr, true);
        // dd($hasil);
        return $hasil;
        // $return = Response($model->where('f_pnwr', $f_pnwr)->get());
        // return Response($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, $_internal=false)
    {
        $hasil = [];
        //
        // dd($request->all());
        if($_internal){
            $data = modelMst::where('f_pnwr',$id)->where('sys_status_aktif','A')->get();
        } else {
            $data = modelMst::where('f_pnwr',$request->_id)->where('sys_status_aktif','A')->get();
        }

        foreach ($data as $key => $value) {
            $hasil[$key]['tayang_tgl'] = Carbon::parse($value['tayang_tgl'])->format('m/d/Y');
            $hasil[$key]['tayang_jam'] = explode(",",$value['tayang_jam']);

        }

        // echo json_encode(($return));
        // dd($hasil);
        // dd($data);

        // return Response(collect($hasil));
        // echo Response(collect($data));
        // echo '<p></p>';
        // echo Response(collect($hasil));
        return Response($hasil);
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
