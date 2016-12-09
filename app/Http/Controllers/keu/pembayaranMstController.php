<?php

namespace App\Http\Controllers\keu;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\keu\fa_pembayaran_mst as ModelMst;
use App\Http\Models\keu\fa_pembayaran_det as ModelDet;
use App\Http\Models\keu\fa_pembayaran_bank_det as ModelBankDet;
use App\Http\Models\keu\fa_pembayaran_giro_det as ModelGiroDet;
use App\Http\Models\keu\fa_pembayaran_jurnal_det as ModelJurnalDet;

//use App\Http\Models\keu\fa_jenis_trans_mst as ModelJurnalDet;

use Carbon;
use DB;
use Terbilang;
use PDF;

class pembayaranMstController extends Controller
{

    public function _index(){
        //return view('keu/pembayaran/tblNotaPembayaran');
        return view('modules/keu/pembayaran');
    }

    private function generate_id($_jenis){
        //BM2016070086
        // $max_id = modelMst::where('no_bukti','like',$_jenis.'M'.date('Y').'07%')->max('no_bukti');
        $max_id = modelMst::where('no_bukti','like',$_jenis.'K'.date('Ym').'%')->max('no_bukti');
        return $_jenis.'K'.date('Ym').(!empty($max_id) ? str_pad(((int)substr($max_id, 8)+1),4,'0',STR_PAD_LEFT) : '0001'); 
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
            $items = modelMst::where("no_bukti", "LIKE", "%".$request->get('search')."%")
                     //->where("status_aktif","=","A")
                     ->paginate(5);      
        }else{
          //$items = modelMst::where("status_aktif","=","A")->paginate(5);
          $items = modelMst::paginate(5);
        }
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
        //
        DB::enableQueryLog();
        //Sat Dec 31 2016 00:00:00 GMT+0700 (SE Asia Standard Time)
        $tgl_cetak = \DateTime::createFromFormat('D M d Y H:i:s e+', $request->tgl_cetak);

        $no_bukti =  $this->generate_id($request->jenis_bukti);

        $request->offsetSet("no_bukti", $no_bukti);
        $request->offsetSet("jenis_bukti", $request->jenis_bukti);
        //$request->offsetSet("tgl_cetak", Carbon::parse($request->tgl_cetak));
        $request->offsetSet("tgl_cetak", $tgl_cetak);
        $request->offsetSet("terbilang", UcWords(Terbilang::make($request->total, ' Rupiah')));
        $request->offsetSet("total", $request->total);
        $request->offsetSet("lks", 'JAG');
        $request->offsetSet("di_customer", !empty($request->di_customer) ? $request->di_customer : '');
        $request->offsetSet("status", $request->status);
        $request->offsetSet("posting", 0);

        modelMst::create($request->except(['bpk','bpb_b', 'bpb_j', 'bpc', 'gl' ,'gl_a', 'gl_c', 'ap']));
        
        $this->insDetail($request, $no_bukti);

        //dd(DB::getQueryLog());
        //dd($request->all());
        //return modelMst::find($no_bukti);

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
        DB::enableQueryLog();
        $items = modelMst::with('fa_pembayaran_det','fa_pembayaran_bank_det.fa_bank_mst','fa_pembayaran_bank_det.fa_jenis_trans_mst','fa_pembayaran_giro_det','fa_pembayaran_jurnal_det.acc_coas_mst', 'fa_pembayaran_jurnal_det.acc_cost_center', 'fa_pembayaran_ap_det')->find($id);   
        //dd($items);
        //die(); 
        return response($items);
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
        DB::enableQueryLog();
        $tgl_cetak = \DateTime::createFromFormat('D M d Y H:i:s e+', $request->tgl_cetak);

        $request->offsetSet("jenis_bukti", $request->jenis_bukti);
        $request->offsetSet("tgl_cetak", $tgl_cetak);
        $request->offsetSet("terbilang", UcWords(Terbilang::make($request->total, ' Rupiah')));
        $request->offsetSet("total", $request->total);
        $request->offsetSet("di_customer", !empty($request->di_customer) ? $request->di_customer : '');
        $request->offsetSet("status", $request->status);

        modelMst::find($id)->update($request->except(['bpk','bpb_b', 'bpb_j', 'bpc', 'gl' ,'gl_a', 'gl_c', 'ap']));
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

    public function insDetail($request, $no_bukti){

        if($request->jenis_bukti == 'K'){
            if($request->bpk){
            $bpk  = $request->bpk;
            //print_r($bpk);
            foreach ($bpk as $key => $value) {
                $bpk[$key]['no_bukti'] = $no_bukti;
                unset($bpk[$key]['$$hashKey']);
            }
            modelDet::insert($bpk);
            }
        }

        elseif($request->jenis_bukti == 'B'){
            //print_r($request->bpb);
            //print_r($request->bpb_b);
            //print_r($request->bpb_j);

            $bpb                    = $request->bpb;
            $bpb['no_bukti']        = $no_bukti;
            $bpb['no_bank']         = $request->bpb_b['no_bank'];
            $bpb['account_bank']    = $request->bpb_b['account_bank'];
            $bpb['jenis_trans']     = $request->bpb_j['jenis_trans'];
            //print_r($bpb);
            modelBankDet::insert($bpb);
        }
        elseif($request->jenis_bukti == 'G'){
            if($request->bpc){
                $bpc  = $request->bpc;
                //dd($bpc);
                foreach ($bpc as $key => $value) {
                    $bpc[$key]['no_bukti']  = $no_bukti;
                    $bpc[$key]['jth_tempo'] = \DateTime::createFromFormat('D M d Y H:i:s e+', $value['jth_tempo']);
                    unset($bpc[$key]['$$hashKey']);
                }
                //dd($bpc);
                modelGiroDet::insert($bpc);
            }
        }

        //if($request->gl_a){
        if($request->gl){
            $gl  = $request->gl;
            foreach ($gl as $key => $value) {
                $gl[$key]['no_bukti']   = $no_bukti;
                //$gl[$key]['coa_id']     = $request->gl_a[$key]['coa_id'];
                //$gl[$key]['costcenter'] = !empty($request->gl_c[$key]['costcenter']) ? $request->gl_c[$key]['costcenter'] : null;
                $gl[$key]['costcenter'] = !empty($request->gl[$key]['costcenter']) ? $request->gl[$key]['costcenter'] : null;
                unset($gl[$key]['$$hashKey']);
                unset($gl[$key]['dept']);
                unset($gl[$key]['coa_name']);
                unset($gl[$key]['cost_keterangan']);
                unset($gl[$key]['acc_cost_center']);
                unset($gl[$key]['acc_coas_mst']);
            }
            //dd($gl);
            modelJurnalDet::insert($gl);   
        }
    }

    private function delDetail($id)
    {
        modelDet::where('no_bukti', $id)->delete();
        modelBankDet::where('no_bukti', $id)->delete();
        modelGiroDet::where('no_bukti', $id)->delete();
        modelJurnalDet::where('no_bukti', $id)->delete();
    }

    public function rptPembayaran(Request $request){
        return view('modules/keu/form/frmRptPembayaran');
    }

    public function rptNotaPembayaran(Request $request){
        //dd($request);
        $query = DB::table("bi_keu.fa_pembayaran_mst_det_view a")
                    ->select(
                        "distinct a.no_bukti", 
                        "tgl_cetak", 
                        "DECODE(a.jenis_bukti,'B','X',' ') B",
                        "DECODE(A.JENIS_BUKTI,'K','X',' ') K",
                        "DECODE(A.JENIS_BUKTI,'CHEQUE/GIRO/TT','X',' ') C_G_TT",
                        "A.NO_PPB",
                        "INITCAP(A.TERBILANG) TERBILANG",
                        "A.BAGIAN",
                        "A.TOTAL total",
                        "A.NOTA_DARI",
                        "A.NO_NPUM",
                        "A.NO_CUSTOMER",
                        "'' CUST_NAME",
                        "A.KETERANGAN",
                        "A.JUMLAH",
                        "A.MATA_UANG",
                        "A.DI_CUSTOMER"
                    );

        if($request->berdasarkan == "true"){
            $items = $query->whereBetween("a.no_bukti", [$request->bukti_awal, $request->bukti_akhir])->get();
            //echo $request->bukti_awal;
            //echo $request->bukti_akhir;
        }
        else {
            $items = $query->whereBetween("a.tgl_cetak", [$request->tgl_awal, $request->tgl_akhir])->get();
            //echo $request->tgl_awal;
            //echo $request->tgl_akhir;
        }
        
        $output = 'pdf';            
        if($output == 'pdf'){
            $pdf = PDF::loadView('modules.keu.report.notaPembayaran', ['vData' => $items])->setPaper('a4');//->setOrientation('landscape');
            return $pdf->download('nota_pembayaran.pdf');
        }
        else{
            Excel::create('Daftar Voucher', function($excel) use ($hasil) {
            $excel->sheet('Excel sheet', function($sheet) use ($hasil) {
                $sheet->loadView('modules.keu.report.nota_pembayaran')->with('vData', $hasil)->with('vDet', $det);
            });
            $excel->setTitle('Daftar Voucher');     
            })->export('xls'); 
        }
    }

    public function pembayaranMstDet(Request $request){

    }
}
