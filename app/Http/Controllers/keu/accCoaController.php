<?php

namespace App\Http\Controllers\KEU;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

//use App\Http\Models\keu\fa_npb_mst as modelMst;

class accCoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function _index()
    {
        //
    }

    public function index(Request $request)
    {
        //
        /*$query = "SELECT COA COA_ID, NAMA_REK COA_NAME
                    FROM (
                        SELECT a.COA, a.NAMA_REK
                        FROM BI_ACC.ACC_COAS_VIEW a
                        WHERE a.NAMA IN ('LEVEL4')
                        and a.coa not in (
                            SELECT SUBSTR (coa, 1, 9)
                            FROM BI_ACC.ACC_COAS_VIEW
                            WHERE ACC_COAS_VIEW.NAMA IN ('LEVEL5')
                        )
                        union all
                        SELECT a.COA, a.NAMA_REK
                        FROM BI_ACC.ACC_COAS_VIEW a
                        WHERE a.NAMA IN ('LEVEL5')
                        and SUBSTR (a.coa, 1, 9) in (
                            SELECT coa
                            FROM BI_ACC.ACC_COAS_VIEW
                            WHERE ACC_COAS_VIEW.$count = DB::table( DB::raw("({$sub->toSql()}) as sub") )NAMA IN ('LEVEL4')
                        )
                    )
                    ORDER BY 1";*/
        DB::enableQueryLog();
        
        /*$query = DB::table('bi_acc.acc_coas_view a')
                    ->select('a.coa as coa_id', 'a.nama_rek as coa_name')
                    ->where('a.nama','LEVEL4')
                    ->whereNotIn('a.coa', function($squery){
                        $squery->select('SUBSTR(b.coa, 1, 9)')
                        ->from('bi_acc.acc_coas_view b')
                        ->where('b.nama','LEVEL5');
                    });
        $query2 = DB::table('bi_acc.acc_coas_view aa')
                    ->select('aa.coa as coa_id', 'aa.nama_rek as coa_name')
                    ->where('aa.nama','LEVEL5')
                    ->whereNotIn('aa.coa', function($squery2){
                        $squery2->select('SUBSTR(bb.coa, 1, 9)')
                        ->from('bi_acc.acc_coas_view bb')
                        ->where('bb.nama','LEVEL4');
                    })
                    ->unionAll($query);
        $query3 = DB::table(DB::raw('(' . $query2 . ')'))->get();*/
        
        $query = DB::table('bi_acc.acc_coas_view a')
                        ->select('a.coa as coa_id', 'a.nama_rek as coa_name')
                        ->where(function ($squery) {
                            $squery->whereNotIn('a.coa', function($squery2) {
                                $squery2->select('SUBSTR(coa, 1, 9)')
                                        ->from('bi_acc.acc_coas_view')
                                        ->where('nama','LEVEL5');
                            })
                            ->Where('a.nama','LEVEL4');
                        })
                        ->orWhere(function ($squery3){
                            $squery3->whereNotIn('a.coa', function($squery4){
                                $squery4->select('SUBSTR(coa, 1, 9)')
                                        ->from('bi_acc.acc_coas_view')
                                        ->where('nama','LEVEL4');
                            })
                            ->Where('a.nama','LEVEL5');
                        });
                        //->get();

        //dd(DB::getQueryLog());
        //dd($query);

        if($request->get('search')){
            $items = $query->where("coa_id", "LIKE", "%".$request->get('search')."%")->paginate(5); 
        }else{
            $items = $query->paginate(5);
        }   
        /*if($request->get('search')){
            $items = modelMst::where("coa_id", "LIKE", "%".$request->get('search')."%")
                     ->paginate(5);      
        }else{
            $items = modelMst::paginate(5);
        }*/
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
    public function store(Request $request)
    {
        //
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
