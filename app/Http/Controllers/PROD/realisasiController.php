<?php

namespace App\Http\Controllers\PROD;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\pms\pms_pnwr_tayang as modelMst;
use App\Http\Requests\reqPmsPnwrTayang as reqMst;
use Carbon;
use DB;

class realisasiController extends Controller
{

    var $tempDate ;
    /**
     * @function __construct dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function __construct()
    {
        $this->tempDate = Carbon::today();
    }
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
            $hasil['tanggal']   = $this->tempDate;
            $hasil['data']      = modelMst::with('pnwr','pnwr.customer')->where('sys_status_aktif','A')->where('tayang_tgl',$hasil['tanggal'])->get();

        }else{
            $this->tempDate     = Carbon::parse($id);    
            $hasil['tanggal']   = $this->tempDate;//->format('m/d/Y');
            $hasil['data']      = modelMst::where('sys_status_aktif','A')->where('tayang_tgl',$hasil['tanggal'])->get(); 
        }
        //dd(DB::getQueryLog());
        
        if(!empty($hasil['data']))
            foreach($hasil['data'] as $index=>$isi){
                // dd($isi->tayang_realisasi);
                $tayang_realisasi = explode(",", $isi->tayang_realisasi);
                // $hasil['data'][$index]['jam']   = explode(',',$isi->tayang_jam);
                foreach (explode(',',$isi->tayang_jam) as $key => $value) {
                    $jam[$index][]                              = (int)substr($value,0,2);
                    $menit[(int)substr($value,0,2)]             = (int)substr($value,2,2);
                    $realisasiMenit[(int)substr($value,0,2)]    = (int)substr($tayang_realisasi[$key],2,2);
                    // $hasil['data'][$index]['jam'][$key] = substr($value,0,2);
                    // echo $index.' = '.substr($value,0,2)."\\n";               
                }       
                // $jam[$index] = array_unique($jam[$index]);
                $hasil['data'][$index]['jam']       = $jam;
                $hasil['data'][$index]['menit']     = $menit;
                $hasil['data'][$index]['realMenit'] = $realisasiMenit;
                // echo '\n';
                // dd($hasil['data'][$index]);
                // print_r(array_unique($jam[$index]));
                // print_r($jam[$index]);
            }
        // dd($hasil['data']);
                // dd($jam);

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
        // dd($request->all());
        $hasil = $request->all();
        // print_r($hasil);
        // die();
        // $_temp = [];
        foreach ( $hasil as $key => $value) {
            foreach ( array_keys($value) as $key2 => $value2) {
                // $_temp['tayang_realisasi'][$key][] = ($key2<count($value) ? $value[$value2] : null);
                
                if($key2 <= 0 ) {
                    $_temp['tayang_realisasi'][$key] = ''; 
                    $_temp['f_pnwr'][$key] = $value['pnwr']; 
                }

                if($value2 !== 'pnwr') {
                    $_temp['tayang_realisasi'][$key] .= $key2 < (count($value)-2) ? str_pad($value2,2,'0',STR_PAD_LEFT).str_pad($value[$value2],2,'0',STR_PAD_LEFT).',' : str_pad($value2,2,'0',STR_PAD_LEFT).str_pad($value[$value2],2,'0',STR_PAD_LEFT); 
                } 

                // echo $key2.'/'.(count($value)-1).'<br/>';
                // echo $value2.'/';
                // print_r($value2);
            }

            modelMst::where('f_pnwr',$_temp['f_pnwr'][$key])->where('tayang_tgl',$this->tempDate)->update(['tayang_realisasi'=>$_temp['tayang_realisasi'][$key]]);
            # code...
            // $_temp[] = $key.$value;

            // print_r($value['pnwr']); 
            // echo array_key($value.'<br/>'; 
        }

        // dd($_temp);
        $this->show(null, $this->tempDate);
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
