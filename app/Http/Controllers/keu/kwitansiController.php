<?php

namespace App\Http\Controllers\keu;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\keu\kwitansi_mst as modelMst;
use App\Http\Models\keu\kwitansi_det as modelDet;
use App\Http\Models\keu\fa_fpajak_mst_nomor as modelFPajak;
use Carbon;
use DB;
use Terbilang;

class kwitansiController extends Controller
{

    public function _index(){
        return view('modules/keu/kwitansi');
    }

    private function generate_id($_jenis){
        $max_id = modelMst::where('no_kwitansi','like','%-'.$_jenis)->max('no_kwitansi');
        return (!empty($max_id) ? str_pad(((int)substr($max_id, 0, 5)+1),5,'0',STR_PAD_LEFT).'-'.$_jenis : '0001-'.$_jenis); 
    }

    public function getFpajak(){
        $no = modelFPajak::select("nomor_surat_pajak", "nomor_depan")
                ->where('default_cetak', '=', 'Y')
                ->first();
        return($no);
    }

    public function getMaxFpajak(){
        $no = modelDet::join('bi_keu.fa_fpajak_mst_nomor a', 'f_sk_fpajak','=','nomor_surat_pajak')
                ->where('a.default_cetak', '=', 'Y')
                ->where('a.sys_status_aktif', '=','A')
                ->max('nomor_belakang');
        return($no);
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
            $items = modelMst::where("sys_status_aktif", "=", "A")->where("deskripsi", "LIKE", "%".$request->get('search')."%")->paginate(5);      
        }else{
            $items = modelMst::where("sys_status_aktif", "=", "A")->paginate(5);
        }
        //dd($items[0]);
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
        $tgl_kwitansi   = \DateTime::createFromFormat('D M d Y H:i:s e+', $request->tgl_kwitansi);
        $year           =  date_format($tgl_kwitansi, 'Y'); 
        $no_kwitansi    =  $this->generate_id($year);
        
        $jumlah         = !empty($request->nilai_kwitansi) ? $request->nilai_kwitansi : 0;

        $request->offsetSet("no_kwitansi", $no_kwitansi);
        $request->offsetSet("jenis", 'N');
        $request->offsetSet("tgl_kwitansi", $tgl_kwitansi);
        $request->offsetSet("tgl_jth_tempo", '');
        $request->offsetSet("kategori", 'RIL');
        $request->offsetSet("deskripsi", $request->deskripsi);
        $request->offsetSet("nilai_kwitansi", $jumlah);
        $request->offsetSet("terbilang", UcWords(Terbilang::make($jumlah, ' Rupiah')));
        $request->offsetSet("mengetahui", $request->mengetahui);
        $request->offsetSet("kode_customer", $request->kode_customer);
        $request->offsetSet("nama_customer", $request->nama_customer);
        $request->offsetSet("cetak", '');
        $request->offsetSet("status_posting", 'N');
        $request->offsetSet("sys_user_update", '');
        $request->offsetSet("sys_tgl_update", Carbon::now());
        $request->offsetSet("sys_status_aktif", 'A');
        $request->offsetSet("no_kwitansi_lama", !empty($request->no_kwitansi_lama) ? $request->no_kwitansi_lama : '');
        $request->offsetSet("alamat_kirim", '');

        modelMst::create($request->except(['det']));

        $this->insDetail($request, $no_kwitansi);

        //dd(DB::getQueryLog());
        //dd($request->all());
        //return modelMst::find($no_bukti);

        return $this->edit($no_kwitansi);
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
        $new_id = $id; //str_replace('_', '/', $id);
        $items = modelMst::with('sdm_pegawai_mst', 'kwitansi_det.pms_fp_mst')->find($new_id);   
        
        //dd(DB::getQueryLog());
        //dd($id);
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
        //DB::enableQueryLog();
        //Sat Dec 31 2016 00:00:00 GMT+0700 (SE Asia Standard Time)
        $tgl_kwitansi   = \DateTime::createFromFormat('D M d Y H:i:s e+', $request->tgl_kwitansi);
        $year           =  date_format($tgl_kwitansi, 'Y'); 
        
        $jumlah         = !empty($request->nilai_kwitansi) ? $request->nilai_kwitansi : 0;

        $request->offsetSet("tgl_kwitansi", $tgl_kwitansi);
        $request->offsetSet("deskripsi", $request->deskripsi);
        $request->offsetSet("nilai_kwitansi", $jumlah);
        $request->offsetSet("terbilang", UcWords(Terbilang::make($jumlah, ' Rupiah')));
        $request->offsetSet("mengetahui", $request->mengetahui);
        $request->offsetSet("kode_customer", $request->kode_customer);
        $request->offsetSet("nama_customer", $request->nama_customer);
        $request->offsetSet("sys_tgl_update", Carbon::now());
        $request->offsetSet("no_kwitansi_lama", !empty($request->no_kwitansi_lama) ? $request->no_kwitansi_lama : '');

        //modelMst::find(str_replace('_', '/', $id))->update($request->except(['det']));
        
        $this->delDetail($id);
        $this->insDetail($request, $id);

        //dd(DB::getQueryLog());
        //dd($request->all());
        //return modelMst::find($no_bukti);

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

    public function insDetail($request, $no_kwitansi){
        //dd($request->det);
        if($request->det){
            $det  = $request->det;
            foreach ($det as $key => $value) {

                $det[$key]['f_kwitansi']        = $no_kwitansi;
                $det[$key]['f_fp']              = $request->det[$key]['f_fp'];
                $det[$key]['depan_fpajak']      = $request->depan_fpajak;
                $det[$key]['no_fpajak']         = $request->no_fpajak;
                $det[$key]['cetak_no_fpajak']   = 'Y';
                $det[$key]['f_sk_fpajak']       = $request->f_sk_fpajak;
                $det[$key]['jenis_fpajak']      = $request->jenis_fpajak;
                $det[$key]['nilai_faktur']      = $request->det[$key]['nilai_faktur'];
                $det[$key]['sys_tgl_update']    = Carbon::now();
                $det[$key]['sys_user_update']   = null;
                $det[$key]['sys_status_aktif']  = 'A';

                unset($det[$key]['$$hashKey']);
                unset($det[$key]['tgl_fp']);
                unset($det[$key]['keterangan']);
            }

            //DB::enableQueryLog();
            modelDet::insert($det);   
            //dd(DB::getQueryLog());
        }
    }

    public function delDetail($id){
        modelDet::where('f_kwitansi', $id)->delete();
    }
}
