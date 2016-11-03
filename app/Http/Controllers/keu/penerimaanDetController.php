<?php

namespace App\Http\Controllers\keu;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\keu\fa_penerimaan_det as modelDet;
use DB;

class penerimaanDetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
    public function show(Request $request, $id)
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
    public function destroy($id, Request $request)
    {
        //
        dd($request->all());
        modelDet::destroy($id);
    }

    public function seriSetoranBank(Request $request){
        if($request->get('search')) {
            $items = modelDet::with('fa_bank_mst')
                        ->where("no_giro", "LIKE", "%".$request->get('search')."%")
                        ->where('no_bukti', 'like', 'GM%')
                        ->whereNotNull('no_giro')
                        ->WhereIn('no_giro', function ($query) {
                            $query->select('no_seri')
                                ->from('bi_keu.fa_setoran_bank_det')
                                ->whereNotNull('no_seri');
                        })
                        ->paginate(5);      
        } 
        else {
            //DB::enableQueryLog();
            $items = modelDet::with('fa_bank_mst')
                        ->where('no_bukti', 'like', 'GM%')
                        ->whereNotNull('no_giro')
                        ->WhereNotIn('no_giro', function ($query) {
                            $query->select('no_seri')
                                ->from('bi_keu.fa_setoran_bank_det')
                                ->whereNotNull('no_seri');
                        })
                        ->paginate(5);
            //dd(DB::getQueryLog());
        }
        //dd($items);
        return response($items); 
    }
}