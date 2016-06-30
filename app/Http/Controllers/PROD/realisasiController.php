<?php

namespace App\Http\Controllers\PROD;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\pms_pnwr_tayang as modelMst;
use App\Http\Requests\reqPmsPnwrTayang as reqMst;
use Carbon;
use DB;

class realisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('prod/realisasi');
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
        DB::enableQueryLog();

        // $hasil = new Object();

        if($id == 'NONID'){
            // $hasil = modelMst::with('pnwr')->where('sys_status_aktif','A')->where('tayang_tgl',Carbon::today())->paginate(5);
            // $hasil['tanggal'] = Carbon::today();
            $hasil['tanggal'] = Carbon::parse('06/23/2016');
            $hasil['data']  = modelMst::with('pnwr','pnwr.customer')->where('sys_status_aktif','A')->where('tayang_tgl',$hasil['tanggal'])->get();

        }else{
            $hasil['tanggal'] = Carbon::parse($id);//->format('m/d/Y');
            $hasil['data'] = modelMst::where('sys_status_aktif','A')->where('tayang_tgl',$hasil['tanggal'])->get(); 
        }
        
        if(!empty($hasil['data']))
            foreach($hasil['data'] as $index=>$isi){
                // dd($isi->tayang_jam);
                // $hasil['data'][$index]['jam']   = explode(',',$isi->tayang_jam);
                foreach (explode(',',$isi->tayang_jam) as $key => $value) {
                    $jam[$index][] = (int)substr($value,0,2);
                    // $hasil['data'][$index]['jam'][$key] = substr($value,0,2);
                    // echo $index.' = '.substr($value,0,2)."\\n";               
                }       
                $jam[$index] = array_unique($jam[$index]);
                $hasil['data'][$index]['jam'] = $jam;
                // dd($hasil['data'][$index]['jam']);
                // echo '\n';
                // dd($hasil['data'][$index]);
                // print_r(array_unique($jam[$index]));
                // print_r($jam[$index]);
            }
                // dd($jam);

        // dd(DB::getQueryLog());
        // dd($hasil);
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
