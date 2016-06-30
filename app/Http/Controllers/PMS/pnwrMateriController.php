<?php

namespace App\Http\Controllers\PMS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\pms_pnwr_materi as modelMst;
use App\Http\Requests\reqPmsPnwrMateri as reqMst;
use Carbon;
use DB;

class pnwrMateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(reqMst $request)//, modelMst $model)
    {
        //
        // dd($request->all());
        // DB::enableQueryLog();    

        $model = modelMst::firstOrNew(['f_pnwr'=>$request->f_pnwr , 'sys_status_aktif'=>'A']);
 

        if($model->exists){
            $model->where('f_pnwr',$request->f_pnwr)->update(['materi_tayang'=>$request->materi_tayang, 'sys_tgl_update'=>Carbon::now()]);
        }else{
            $model->materi_tayang = $request->materi_tayang;
            $model->sys_user_update = 'ADMIN';
            $model->save();
        }
 
        // dd(DB::getQueryLog());   

        return Response($model->where('f_pnwr',$request->f_pnwr)->where('sys_status_aktif','A')->first());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)//, $_internal=false)
    {
        $data = modelMst::where('f_pnwr',$request->_id)->where('sys_status_aktif','A')->first();

        return Response($data);
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
    public function update(reqMst $request, $id)
    {
        // DB::enableQueryLog();    
        $model = modelMst::where('f_pnwr',$request->f_pnwr)->where('sys_status_aktif','A')->findOrFail();
        if($model)
            $model->fill($request->all())->save();
        else return false;
        // dd(DB::getQueryLog());   

        return Response($model->where('f_pnwr',$request->f_pnwr)->first());
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
