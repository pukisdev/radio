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
        // dd($request->all());
        // dd($request->fp_det);
        $input['fp_det']  = $request->fp_det;

        $id_fp = $this->generate_id();
        $netto = 0;

        foreach ($input['fp_det'] as $key => $value) {
            $input['fp_det'][$key]['f_fp'] = $id_fp;
            $input['fp_det'][$key]['sys_user_update'] = 'ADMIN';
            $netto += $value['nilai_akhir'];
            unset($input['fp_det'][$key]['judul_iklan']);
        }

        // dd($input['fp_det']);

        modelMst::create([
                    'id_fp'             => $id_fp,
                    'generate_ke'       => 1,
                    'f_customer'        => $request->f_customer,
                    'tgl_fp'            => Carbon::parse($request->tgl_fp),
                    'deskripsi_fp'      => $request->deskripsi_fp,
                    'tgl_jatuh_tempo'   => Carbon::parse($request->tgl_jatuh_tempo),
                    'jenis_faktur'      => $request->jenis_faktur,
                    'keterangan'        => $request->keterangan,
                    'ttd'               => $request->ttd,
                    'netto'             => $netto,
                    'netto_terbilang'   => 'Seratus',
                    'sys_user_update'   => 'ADMIN'
                ]);

        modelDet::insert($input['fp_det']);

        // dd($request->all());
        
        return modelMst::find($id_fp);//Model::find($request->id_customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // DB::enableQueryLog();    
        // $items = modelMst::with('customer','fp_det.pnwr')->find($request->_id);

        $items = modelMst::with(['customer', 'fp_det' => function($query){
                                    $query->where('sys_status_aktif','A'); 
                                }, 'fp_det.pnwr']
            )->find($request->_id);
    
        // dd(DB::getQueryLog());   
                
        // dd($items->fp_det);
        return response($items);
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

        $f_pnwr         = "";
        $netto          = 0;
        $input['fp_det']= $request->fp_det;

        foreach ($input['fp_det'] as $key => $value) {
            $f_pnwr[]   = $value['f_pnwr']; 
            $netto      += $value['nilai_akhir'];

            $input['fp_det'][$key]['sys_user_update']   = 'ADMIN';
            unset($input['fp_det'][$key]['judul_iklan']);
            unset($input['fp_det'][$key]['pnwr']);
            
            if(modelDet::where([['f_fp',$id], ['f_pnwr',$value['f_pnwr']],['sys_status_aktif','A']])->count() > 0){
                unset($input['fp_det'][$key]['f_fp']);
                unset($input['fp_det'][$key]['f_pnwr']);
                modelDet::where([['f_fp',$id],['sys_status_aktif','A']])->where('f_pnwr',$value['f_pnwr'])->update($input['fp_det'][$key]);
            } else {
                $input['fp_det'][$key]['f_fp'] = $id;
                modelDet::insert($input['fp_det'][$key]);
            }
        }
        // $isKwintasi = DB::table('kwitansi_det')->where(['f_fp'=>$id, 'sys_status_aktif'=>'A'])->count();
        


        modelMst::where('id_fp',$id)->update([
                    'generate_ke'       => 1,
                    'f_customer'        => $request->f_customer,
                    'tgl_fp'            => Carbon::parse($request->tgl_fp),
                    'deskripsi_fp'      => $request->deskripsi_fp,
                    'tgl_jatuh_tempo'   => Carbon::parse($request->tgl_jatuh_tempo),
                    'jenis_faktur'      => $request->jenis_faktur,
                    'keterangan'        => $request->keterangan,
                    'ttd'               => $request->ttd,
                    'netto'             => $netto,
                    'netto_terbilang'   => 'Seratus',
                    'sys_user_update'   => 'ADMIN'
                ]);

        // modelDet::where('f_fp',$id)->delete();
        // modelDet::where('f_fp',$id)->update(['sys_status_aktif'=>'A']);

        // dd($input['fp_det']);

        // modelDet::insert($input['fp_det']);

        // dd($request->all());
        
        // return modelMst::find($id_fp);

        // dd($input['fp_det']);
        // dd($request->all());
        // $pnwrMst = modelMst::findOrFail($id);
        // if($pnwrMst)
            // $pnwrMst->fill($request->all())->save();
            // dd(DB::getQueryLog());


        // $id_fp = $this->generate_id();
        // $netto = 0;

        // foreach ($input['fp_det'] as $key => $value) {
        //     $input['fp_det'][$key]['f_fp'] = $id_fp;
        //     $input['fp_det'][$key]['sys_user_update'] = 'ADMIN';
        //     $netto += $value['nilai_akhir'];
        //     unset($input['fp_det'][$key]['judul_iklan']);
        // }

        // // dd($input['fp_det']);

        // modelMst::create([
        //             'id_fp'             => $id_fp,
        //             'generate_ke'       => 1,
        //             'f_customer'        => $request->f_customer,
        //             'tgl_fp'            => Carbon::parse($request->tgl_fp),
        //             'deskripsi_fp'      => $request->deskripsi_fp,
        //             'tgl_jatuh_tempo'   => Carbon::parse($request->tgl_jatuh_tempo),
        //             'jenis_faktur'      => $request->jenis_faktur,
        //             'keterangan'        => $request->keterangan,
        //             'ttd'               => $request->ttd,
        //             'netto'             => $netto,
        //             'netto_terbilang'   => 'Seratus',
        //             'sys_user_update'   => 'ADMIN'
        //         ]);

        // modelDet::insert($input['fp_det']);

        // // dd($request->all());
        
        // return modelMst::find($id_fp);//Model::find($request->id_customer);
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
    private function generate_id(){
        $max_id = modelMst::where('id_fp','like','FP'.date('Y').'%')->max('id_fp');
        return 'FP'.date('Y').'.'.(!empty($max_id) ? str_pad(((int)substr($max_id, strpos($max_id,'.')+1)+1),5,'0',STR_PAD_LEFT) : '00001'); 
    }

}
