<?php

namespace App\Http\Controllers\keu;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\keu\fa_penerimaan_mst as modelMst;
use App\Http\Models\keu\fa_penerimaan_det as modelDet;
use App\Http\Models\keu\fa_penerimaan_ar_det as arDet;
use App\Http\Models\keu\fa_penerimaan_ap_det as apDet;
use App\Http\Models\keu\fa_penerimaan_jurnal_det as jurnalDet;
// use App\Http\Requests\reqPmsFpMst as reqMst;
use Carbon;
use DB;
use Terbilang;

class penerimaanMstController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 
        $query = modelMst::with('fa_penerimaan_det','fa_penerimaan_ar_det','fa_penerimaan_ap_det','fa_penerimaan_jurnal_det');
        if($request->get('search')){
            // $items = modelMst::with('fa_penerimaan_det','fa_penerimaan_ar_det','fa_penerimaan_ap_det','fa_penerimaan_jurnal_det')->where("no_bukti", "LIKE", "%".$request->get('search')."%")->orWhere("keterangan", "LIKE", "%".$request->get('search')."%")->paginate(5);      
            $query->where("no_bukti", "LIKE", "%".$request->get('search')."%")->orWhere("keterangan", "LIKE", "%".$request->get('search')."%");      
        }//else{
            // $items = modelMst::with('fa_penerimaan_det','fa_penerimaan_ar_det','fa_penerimaan_ap_det','fa_penerimaan_jurnal_det')->paginate(5);
        //}
           $items = $query->orderBy('tgl_cetak','desc')->paginate(5);
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
        DB::enableQueryLog();
        // dd($request->all());

        // dd(date('Y H:s:i'));
        $no_bukti =  $this->generate_id($request->jenis_bukti);

        $request->offsetSet("no_bukti", $no_bukti);
        $request->offsetSet("tgl_terima", Carbon::parse($request->tgl_terima));
        $request->offsetSet("tgl_cetak", Carbon::parse($request->tgl_cetak));
        $request->offsetSet("terbilang", UcWords(Terbilang::make($request->total, ' Rupiah')));
        $request->offsetSet("lks", 'JAG');
        $request->offsetSet("posting", 0);

        modelMst::create($request->except(['det','jurnal_det','ar_det','ap_det']));
        
        // dd($ap_det);
        $this->insDetail($request, $no_bukti);

        // dd(DB::getQueryLog());
        // dd($request->all());
        // return modelMst::find($no_bukti);
        return $this->edit($no_bukti);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // DB::enableQueryLog();    
        // dd(DB::getQueryLog());   
        // return response($items);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = modelMst::with('fa_penerimaan_det.fa_bank_mst','fa_penerimaan_ar_det','fa_penerimaan_ap_det','fa_penerimaan_jurnal_det.coa')
                ->find($id);    
        
        return response($items);
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
        dd($request->all());
        // $no_bukti =  $id;
        DB::enableQueryLog();
        $request->offsetUnset("no_bukti");
        $temp['tgl_terima'] = \DateTime::createFromFormat('D M d Y H:i:s e+', $request->tgl_terima);
        // $temp['tgl_cetak']  = \DateTime::createFromFormat('D M d Y H:i:s e+', $request->tgl_cetak);
        $request->offsetSet("tgl_terima", Carbon::parse($request->tgl_terima));
        $request->offsetSet("tgl_cetak", Carbon::parse($request->tgl_cetak));
        // $request->offsetSet("tgl_terima", $temp['tgl_terima']);
        // $request->offsetSet("tgl_cetak", $temp['tgl_cetak']);
        $request->offsetSet("terbilang", UcWords(Terbilang::make($request->total, ' Rupiah')));

        modelMst::find($id)->update($request->except(['det','jurnal_det','ar_det','ap_det']));
        // dd(DB::getQueryLog());
        
        $this->delDetail($id);
        $this->insDetail($request, $id);

        return $this->edit($id);

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

     /**
     * @function generate_id dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return id
     */
    public function _index(){
        return view('modules/keu/penerimaan');
    }

    /**
     * @function generate_id dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return id
     */
    private function generate_id($_jenis){
        //BM2016070086
        // $max_id = modelMst::where('no_bukti','like',$_jenis.'M'.date('Y').'07%')->max('no_bukti');
        $max_id = modelMst::where('no_bukti','like',$_jenis.'M'.date('Ym').'%')->max('no_bukti');
        return $_jenis.'M'.date('Ym').(!empty($max_id) ? str_pad(((int)substr($max_id, 8)+1),4,'0',STR_PAD_LEFT) : '0001'); 
    }


    /**
     * @function insDetail dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    private function insDetail($request, $no_bukti)
    {
        if($request->det){
            $det  = $request->det;
            foreach ($det as $key => $value) {
                $det[$key]['no_bukti'] = $no_bukti;
                $det[$key]['jatuh_tempo'] = Carbon::parse($value['jatuh_tempo']);
                unset($det[$key]['$$hashKey']);
                unset($det[$key]['nama_bank']);
                unset($det[$key]['fa_bank_mst']);
                // $request->det[$key]['no_bukti']= $no_bukti;
                // $request->offsetSet(array(['det'][$key]['no_bukti'], $no_bukti);
            }
        modelDet::insert($det);
        }
        
        if($request->jurnal_det){
            $jurnal_det  = $request->jurnal_det;
            foreach ($jurnal_det as $key => $value) {
                $jurnal_det[$key]['no_bukti'] = $no_bukti;
                $jurnal_det[$key]['currency_id'] = 'IDR';
                unset($jurnal_det[$key]['$$hashKey']);
                unset($jurnal_det[$key]['nama_coa']);
                unset($jurnal_det[$key]['coa']);
            }
            // dd($jurnal_det);
        jurnalDet::insert($jurnal_det);
        }

        if($request->ar_det){
            $ar_det  = $request->ar_det;
            foreach ($ar_det as $key => $value) {
                $ar_det[$key]['no_bukti'] = $no_bukti;
                $ar_det[$key]['currency_id'] = 'IDR';
                $ar_det[$key]['coa_customer'] = $value['coa_id'];
                unset($ar_det[$key]['$$hashKey']);
            }
        arDet::insert($ar_det);
        }

        if($request->ap_det){
            $ap_det  = $request->ap_det;
            foreach ($ap_det as $key => $value) {
                $ap_det[$key]['no_bukti'] = $no_bukti;
                $ap_det[$key]['currency_id'] = 'IDR';
                unset($ap_det[$key]['$$hashKey']);
                unset($ap_det[$key]['nama_customer']);
            }
        apDet::insert($ap_det);
        }
    }


    /**
     * @function delDetail dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    private function delDetail($id)
    {
        modelDet::where('no_bukti', $id)->delete();
        jurnalDet::where('no_bukti', $id)->delete();
        arDet::where('no_bukti', $id)->delete();
        apDet::where('no_bukti', $id)->delete();
    }

}
