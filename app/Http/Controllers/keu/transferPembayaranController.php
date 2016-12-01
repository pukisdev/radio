<?php

namespace App\Http\Controllers\keu;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use App\Http\Models\keu\fa_fpajak_mst_nomor as ModelMst;

use Carbon;
use DB;
use Validator;

class transferPembayaranController extends Controller
{
    private $allowedTransfer;

    public function __construct()
    {
        $this->allowedTransfer = false;
    }

    /**
     * @function proses dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function cekData(Request $request)
    {
        // dd($request->all());
        $periode                = $request->bulan.'/'.$request->tahun;
        $data['coa']            = $this->cekCoa($periode);
        $data['faktur']         = $this->cekFaktur($periode);
        $data['detailTransfer'] = $this->getDetailTransfer($periode);

        if(count($data['coa']) <= 0 and count($data['faktur']) <= 0) $this->allowedTransfer = true;
        // dd($data);
        return response($data);
    }

    /**
     * @function transfer dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function transfer(Request $request)
    {
        $periode = $request->bulan.'/'.$request->tahun;
        $this->cancelApGl($periode);
        $this->postingGlPembayaran($periode);
        $this->balancingFaktur($periode);

        return 'what?';
    }
 


    /**
     * @function postingGPenerimaan dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    private function postingGlPembayaran($periode)
    // private function postingGlPembayaran(Request $request)//($periode)
    {
        $today = Carbon::now();

        DB::enableQueryLog();
        // $periode = $request->periode;
         //     CURSOR C_NP_MST IS   
         //        SELECT A.LKS,
         //               A.NO_BUKTI,
         //               A.TGL_CETAK,
         //               NVL(A.TOTAL,0),
         //               A.KETERANGAN
         //        FROM    BI_KEU.FA_PEMBAYARAN_MST A
         //        WHERE A.TGL_CETAK BETWEEN TRUNC(:MAIN.PERIODE,'MM') AND LAST_DAY(:MAIN.PERIODE);
        $data['cNpMst'] = DB::table('bi_keu.fa_pembayaran_mst a')
                            ->select(DB::raw('a.lks, a.no_bukti, a.tgl_cetak, nvl(a.total,0) total, keterangan, a.jenis_bukti'))
                            ->whereRaw("tgl_cetak between trunc(to_date('".$periode."','mm/yyyy'),'MM') and last_day(to_date('".$periode."','mm/yyyy'))")
                            ->get();


        //  CURSOR C_NP_DET IS   
        //     SELECT A.NO_BUKTI,
        //        A.COA_ID,
        //        A.CURRENCY_ID,
        //        A.TIPE,
        //        A.NILAI,
        //        B.LKS,
        //        A.KETERANGAN
        //     FROM   BI_KEU.FA_PEMBAYARAN_JURNAL_VIEW A,BI_KEU.FA_PEMBAYARAN_MST B
        //     WHERE  B.NO_BUKTI = A.NO_BUKTI 
        // AND    B.TGL_CETAK BETWEEN TRUNC(:MAIN.PERIODE,'MM') AND LAST_DAY(:MAIN.PERIODE);
        $data['cNpDet'] = DB::table('bi_keu.fa_pembayaran_mst b')
                            ->join('bi_keu.fa_pembayaran_jurnal_view a','b.no_bukti','=','a.no_bukti')
                            ->select('a.no_bukti','a.coa_id','a.currency_id','a.tipe','a.nilai','b.lks','a.keterangan')
                            ->whereRaw("b.tgl_cetak between trunc(to_date('".$periode."','mm/yyyy'),'MM') and last_day(to_date('".$periode."','mm/yyyy'))")
                            ->get();
 
        // CURSOR C_KAR IS   
        //   SELECT NO_BUKTI,
        //            COA_ID,
        //              NO_FAKTUR,
        //              CURRENCY_ID,
        //              KETERANGAN,
        //              NILAI_BAYAR,
        //              TGL_CETAK
        //         FROM     BI_KEU.FA_KARTU_HUTANG_BI_VIEW A
        //         WHERE  A.TGL_CETAK BETWEEN TRUNC(:MAIN.PERIODE,'MM') AND LAST_DAY(:MAIN.PERIODE);
        $data['cKar'] = DB::table('bi_keu.fa_kartu_hutang_bi_view a')
                        ->select('no_bukti','coa_id','no_faktur','currency_id','keterangan','nilai_bayar','tgl_cetak')
                        ->whereRaw("tgl_cetak between trunc(to_date('".$periode."','mm/yyyy'),'MM') and last_day(to_date('".$periode."','mm/yyyy'))")
                        ->get();
    
         // CURSOR C_FAK IS   
         //          SELECT A.NO_BUKTI,
         //                 A.COA_ID,
         //                 A.NO_INVOICE,
         //                 A.CURRENCY_ID,
         //                 A.KETERANGAN,
         //                 A.NILAI_BAYAR,
         //                 B.TGL_CETAK
         //            FROM     FA_PEMBAYARAN_AP_DET A,FA_PEMBAYARAN_MST B
         //            WHERE  A.NO_BUKTI = B.NO_BUKTI
         //        AND    B.TGL_CETAK BETWEEN TRUNC(:MAIN.PERIODE,'MM') AND LAST_DAY(:MAIN.PERIODE);
                         
        $data['cFak'] = DB::table('bi_keu.fa_pembayaran_ap_det a')
                          ->join('bi_keu.fa_pembayaran_mst b','a.no_bukti','=','b.no_bukti')
                          ->select('a.no_bukti','a.coa_id','a.no_invoice','a.currency_id','a.keterangan','a.nilai_bayar','b.tgl_cetak')
                          ->whereRaw("tgl_cetak between trunc(to_date('".$periode."','mm/yyyy'),'MM') and last_day(to_date('".$periode."','mm/yyyy'))")
                          ->get();
     
         // CURSOR C_SAL IS                   
         //        SELECT B.NO_BUKTI,
         //               A.TGL_CETAK,
         //               B.COA_ID,
         //               A.LKS,
         //               B.NILAI_BAYAR,
         //               A.KETERANGAN,
         //               'D'||TO_CHAR(A.TGL_CETAK,'mm'),
         //               TO_CHAR(A.TGL_CETAK,'yyyy')
         //        FROM     BI_KEU.FA_PEMBAYARAN_MST A, BI_KEU.FA_PEMBAYARAN_AP_DET B
         //        WHERE  A.NO_BUKTI =B.NO_BUKTI  
         //        AND    A.TGL_CETAK BETWEEN TRUNC(:MAIN.PERIODE,'MM') AND LAST_DAY(:MAIN.PERIODE);

        $data['cSal'] = DB::table('bi_keu.fa_pembayaran_mst a')
                        ->join('bi_keu.fa_pembayaran_ap_det b','a.no_bukti','=','b.no_bukti')
                        ->select('b.no_bukti','a.tgl_cetak','b.coa_id','a.lks','b.nilai_bayar as total','a.keterangan',"'D'||to_char(to_number(to_char(a.tgl_cetak,'mm'))) jenis")
                        ->whereRaw("tgl_cetak between trunc(to_date('".$periode."','mm/yyyy'),'MM') and last_day(to_date('".$periode."','mm/yyyy'))")
                        // ->whereNotNull('b.coa_id')
                        // ->groupBy(DB::raw("b.coa_id, 'K'||to_char(to_number(to_char(a.tgl_terima,'mm'))),to_char(a.tgl_terima,'yyyy')"))
                        ->get();

        // dd(DB::getQueryLog());                 

        foreach ($data['cNpMst'] as $key => $value) {
            $max_number = DB::table('bi_acc.acc_gl_trans_mst')->max('record_number');
            $max_number = ($max_number < 0 || is_null($max_number)) ? 1 : $max_number+1;
            
            // dd($value);
            if ($value->jenis_bukti == 'K') {
              $vjurnal = '02'; 
            } else if($value->jenis_bukti == 'B'){
              $vjurnal = '04';
            } else if($value->jenis_bukti == 'G'){
              $vjurnal = '06';
            }

            $vjmlkode = DB::table('bi_acc.acc_gl_trans_mst')
                        ->where('bukti',$value->no_bukti)
                        ->where('lks', $value->lks)
                        ->count('*');

            if($vjmlkode <= 0){
                DB::table('bi_acc.acc_gl_trans_mst')->insert([
                    'lks'     => $value->lks, 
                    'bukti'   => $value->no_bukti, 
                    'tgl'     => $value->tgl_cetak, 
                    'jurnal'  => $vjurnal,
                    'tdebet'  => $value->total,
                    'tkredit' => $value->total,
                    'posting' => 'N',
                    'record_number' => $max_number,
                    'product_id' => 1
                  ]);
            } else {
                DB::table('bi_acc.acc_gl_trans_mst')
                ->where(['bukti'=>$value->no_bukti, 'lks'=>$value->lks])
                ->update(
                  [
                    'tdebet' => $value->total,
                    'tkredit' => $value->total
                  ]
                );
            }
        }                          

        //---=====================================================
        //---ISI DETAIL GENERAL LEDGER (TABLE ACC_GL_TRANS_DET)
        //---===================================================== 
        // ->select('a.no_bukti','a.coa_id','a.currency_id','a.tipe','a.nilai','b.lks','a.keterangan')

        foreach ($data['cNpDet'] as $key => $value) {
            $max_number = DB::table('bi_acc.acc_gl_trans_mst')->max('record_number');
            $max_number = ($max_number < 0 || is_null($max_number)) ? 1 : $max_number+1;

            // dd($value);
            DB::table('bi_acc.acc_gl_trans_det')->insert([
              'lks'   => $value->lks,
              'rek'   => $value->coa_id,
              'bukti' => $value->no_bukti,
              'urai'  => $value->keterangan,
              'dk'    => $value->tipe,
              'nilai' => $value->nilai,
              'record_number' => $max_number
            ]);


        }


        //  ---=====================================================
        // ---ISI DETAIL GENERAL LEDGER (TABLE ACC_SALDO_HUTANG)
        // ---===================================================== 
        // ->select(DB::raw("b.coa_id, sum(b.nilai_bayar) total, 'K'||to_char(to_number(to_char(a.tgl_terima,'mm'))) jenis, to_char(a.tgl_terima,'yyyy') tahun"))

        $data['salHutang'] = DB::table('bi_acc.acc_saldo_hutang')
                              ->select('coa_id','tahun','d1','d2','d3','d4','d5','d6','d7','d8','d9','d10','d11','d12')
                              ->where('tahun', $today->year)
                              ->get();

        foreach ($data['cSal'] as $key => $value) {
            // dd(array_search($value->coa_id, $data['salPiutang']));
          $salHutang_temp = [];
          // $i = 0;
          foreach ($data['salHutang'] as $key2 => $value2) {
            if($value2->coa_id == $value->coa_id){
              $index = $key2;
              $salHutang_temp  = $value2;
              // $i++;
              // dd($data['salPiutang'][$index]);
              break;
            }
          }

          $d = 0;
          switch ($value->jenis) {
            case 'D1':
              $d = (empty($salHutang_temp) or is_null($salHutang_temp->d1)) ? 0 : $salHutang_temp->d1;
            break;
            case 'D2':
              $d = (empty($salHutang_temp) or is_null($salHutang_temp->d2)) ? 0 : $salHutang_temp->d2;
            break;
            case 'D3':
              $d = (empty($salHutang_temp) or is_null($salHutang_temp->d3)) ? 0 : $salHutang_temp->d3;
            break;
            case 'D3':
              $d = (empty($salHutang_temp) or is_null($salHutang_temp->d3)) ? 0 : $salHutang_temp->d3;
            break;
            case 'D4':
              $d = (empty($salHutang_temp) or is_null($salHutang_temp->d4)) ? 0 : $salHutang_temp->d4;
            break;
            case 'D5':
              $d = (empty($salHutang_temp) or is_null($salHutang_temp->d5)) ? 0 : $salHutang_temp->d5;
            break;
            case 'D6':
              $d = (empty($salHutang_temp) or is_null($salHutang_temp->d6)) ? 0 : $salHutang_temp->d6;
            break;
            case 'D7':
              $d = (empty($salHutang_temp) or is_null($salHutang_temp->d7)) ? 0 : $salHutang_temp->d7;
            break;
            case 'D8':
              $d = (empty($salHutang_temp) or is_null($salHutang_temp->d8)) ? 0 : $salHutang_temp->d8;
            break;
            case 'D9':
              $d = (empty($salHutang_temp) or is_null($salHutang_temp->d9)) ? 0 : $salHutang_temp->d9;
            break;
            case 'D10':
              $d = (empty($salHutang_temp) or is_null($salHutang_temp->d10)) ? 0 : $salHutang_temp->d10;
            break;
            case 'D11':
              $d = (empty($salHutang_temp) or is_null($salHutang_temp->d11)) ? 0 : $salHutang_temp->d11;
            break;
            case 'D12':
              $d = (empty($salHutang_temp) or is_null($salHutang_temp->d12)) ? 0 : $salHutang_temp->d12;
            break;
            default:
              $d=0;
            break;
          }

          // echo 'jenis'.$value->jenis.'<br/>';
          if (DB::table('bi_acc.acc_saldo_hutang')->where(['coa_id'=>$value->coa_id, 'tahun'=>$today->year])->count() > 0) {          
            DB::table('bi_acc.acc_saldo_hutang')
            ->where(['coa_id'=>$value->coa_id, 'tahun'=>$today->year])
            ->update([$value->jenis => $d + (is_null($value->total) ? 0 : $value->total)]);
          } else {
            DB::table('bi_acc.acc_saldo_hutang')
            ->insert([
                'coa_id'=>$value->coa_id, 
                'tahun'=>$today->year,
                'currency'=>'IDR',
                $value->jenis => $d + (is_null($value->total) ? 0 : $value->total)
            ]);            
          }
            
        }

        DB::table('bi_keu.fa_pembayaran_mst')
          ->whereRaw("tgl_cetak between trunc(to_date('".$periode."','mm/yyyy'),'MM') and last_day(to_date('".$periode."','mm/yyyy'))")
          ->where('lks','JAG')
          ->update(['posting'=>1]); 
    }

    /**
     * @function cancelApGl dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    private function cancelApGl($periode)
    {        
        // DB::enableQueryLog();
        // --******** HAPUS DATA PEMBAYARAN KAS BANK PADA G/L *************          
        DB::table('bi_acc.acc_gl_trans_det')
            ->whereIn('bukti', function($query) use ($periode) {
                    $query->select('bukti')
                        ->from('bi_acc.acc_gl_trans_mst')
                        ->whereRaw("tgl between trunc(to_date('".$periode."','mm/yyyy'),'MM') and last_day(to_date('".$periode."','mm/yyyy'))")
                        ->whereIn('jurnal',['02','04','06','08']);
            })
            ->delete();


        DB::table('bi_acc.acc_gl_trans_mst')
            ->whereIn('jurnal',['02','04','06','08'])
            ->whereRaw("tgl between trunc(to_date('".$periode."','mm/yyyy'),'MM') and last_day(to_date('".$periode."','mm/yyyy'))")
            ->delete();
        
        // --******** HAPUS DATA PENERIMAAN KAS BANK PADA KARTU HUTANG *************
        DB::table('bi_acc.acc_kartu_hutang')
            ->where('DK','D')
            ->whereRaw("SUBSTR(NO_BUKTI,1,2) IN ('BK','KK','GK')")
            ->whereRaw("tgl between trunc(to_date('".$periode."','mm/yyyy'),'MM') and last_day(to_date('".$periode."','mm/yyyy'))")
            ->delete();
        // dd(DB::getQueryLog());

    }



    /**
     * @function balancingFaktur dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    protected function balancingFaktur($periode)
    {
        DB::enableQueryLog();

  // --************* UPDATE BAYAR MULAI DARI TGL AWAL TAHUN S/D TGL AKHIR BULAN BERSANGKUTAN *******************
        DB::table('bi_acc.acc_faktur_hutang')
            ->whereIn('no_faktur', function($query) use ($periode){
                $query->select(DB::raw('distinct a.no_invoice'))
                    ->from('bi_keu.fa_pembayaran_ap_det a')
                    ->join('bi_keu.fa_pembayaran_mst b','a.no_bukti','=','b.no_bukti')
                    ->whereRaw("tgl_cetak between trunc(to_date('".$periode."','mm/yyyy'),'YYYY') and last_day(to_date('".$periode."','mm/yyyy'))");
            })->update(['bayar'=>0]);

        DB::table('bi_acc.acc_faktur_hutang')
            ->whereRaw("tgl_faktur between trunc(to_date('".$periode."','mm/yyyy'),'YYYY') and last_day(to_date('".$periode."','mm/yyyy'))")
            ->update(['bayar'=>0]);            
        
        DB::table('bi_acc.acc_faktur_hutang')
            ->whereIn('no_faktur', function($query) use ($periode){
                $query->select(DB::raw('distinct a.no_invoice'))
                    ->from('bi_keu.fa_penerimaan_ap_det a')
                    ->join('bi_keu.fa_penerimaan_mst b','a.no_bukti','=','b.no_bukti')
                    ->whereRaw("tgl_terima between trunc(to_date('".$periode."','mm/yyyy'),'YYYY') and last_day(to_date('".$periode."','mm/yyyy'))");
            })->update(['bayar'=>0]);

    
    // --************** MASUKKAN SALDO AWAL KE FIELD 'BAYAR' **********************
        $data['faktur_sa'] = DB::table('bi_acc.acc_faktur_hutang_sa')->where('sa_tahun',substr($periode,2))->get();

        foreach ($data['faktur_sa'] as $key => $value) {
            DB::table('bi_acc.acc_faktur_hutang')
                ->where('no_faktur',$value->no_faktur)
                ->update(['bayar'=>$value->bayar]);
        }                        
    
    // sampai disini 24/11/2016
    // --************** TAMBAHKAN DENGAN TRANSAKSI PENGELUARAN DARI TGL AWAL TAHUN S/D TGL AKHIR BULAN BERSANGKUTAN  **************
        $data['faktur'] = DB::table('bi_acc.acc_faktur_hutang')->get();


        foreach ($data['faktur'] as $key => $value) {
            $nilai_bayar1 = DB::table('bi_keu.fa_pembayaran_ap_det')
                              ->where('no_invoice', $value->no_faktur)
                              ->whereIn('no_bukti', function($query) use ($periode){
                                  $query->select('no_bukti')
                                    ->from('bi_keu.fa_pembayaran_mst')
                                    ->whereRaw("tgl_cetak between trunc(to_date('".$periode."','mm/yyyy'),'YYYY') and last_day(to_date('".$periode."','mm/yyyy'))");
                              })
                              ->sum('nilai_bayar');
                              // ->get();

            if (!empty($nilai_bayar1) && $nilai_bayar1 <> 0 ) {
                DB::table('bi_acc.acc_faktur_hutang')
                  ->where('no_faktur',$value->no_faktur)
                  ->update(['bayar' => DB::raw('nvl(bayar,0) + '.$nilai_bayar1)]);
            }

    //     -- ********** UPDATE DARI PENERIMAAN AP *******************
            $nilai_bayar2 = DB::table('bi_keu.fa_pembayaran_ap_det')
                              ->where('no_invoice', $value->no_faktur)
                              ->whereIn('no_bukti', function($query) use ($periode){
                                  $query->select('no_bukti')
                                    ->from('bi_keu.fa_penerimaan_mst')
                                    ->whereRaw("tgl_terima between trunc(to_date('".$periode."','mm/yyyy'),'YYYY') and last_day(to_date('".$periode."','mm/yyyy'))");
                              })
                              ->sum('nilai_bayar');
                              // ->get();

            if (!empty($nilai_bayar2) && $nilai_bayar2 <> 0 ) {
              # code...
                DB::table('bi_acc.acc_faktur_hutang')
                ->where('no_faktur', $value->no_faktur)
                ->update(['bayar'=> $value->bayar + $nilai_bayar2]); 
            }
        }            
    }

    /**
     * @function cekCoa dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    private function cekCoa($periode)
    {
        // dd($request->all());
        DB::enableQueryLog();
        $data['coa1'] = DB::table('bi_keu.fa_kartu_hutang_bi_view a')
                        ->select(DB::raw('count(a.coa_id) as total_coa'), 'a.no_bukti')
                        ->whereNull('a.coa_id')
                        ->whereRaw("to_char(a.tgl_cetak,'mm/yyyy') = '".$periode."'")
                        ->groupBy('a.no_bukti');

        $data['coa'] = DB::table('bi_keu.fa_pembayaran_mst b')
                        ->join('bi_keu.fa_pembayaran_jurnal_view a','b.no_bukti','=','a.no_bukti')
                        ->select(DB::raw('count(a.coa_id) as total_coa'), 'a.no_bukti')
                        // ->where('b.posting','=','0')
                        ->whereNull('a.coa_id')
                        ->whereRaw("to_char(b.tgl_cetak,'mm/yyyy') = '".$periode."'")
                        ->groupBy('a.no_bukti')
                        ->union($data['coa1'])
                        ->get();

        return $data['coa'];
        // dd(DB::getQueryLog());
        // dd($data['coa2']);

         // SELECT COUNT(COA_ID) COA_ID, NO_BUKTI
         // FROM (
         // SELECT A.NO_BUKTI,
         //        A.COA_ID
         // FROM   BI_KEU.FA_PEMBAYARAN_JURNAL_VIEW A,BI_KEU.FA_PEMBAYARAN_MST B
         // WHERE  B.NO_BUKTI = A.NO_BUKTI 
         // AND    A.COA_ID IS NULL 
         // AND    (TO_CHAR(B.TGL_CETAK,'MM/YYYY') = TO_CHAR(:UTAMA.PERIODE,'MM/YYYY'))
         // UNION ALL
         // SELECT NO_BUKTI,
         //        COA_ID
         // FROM   BI_KEU.FA_KARTU_HUTANG_BI_VIEW A
         // WHERE  (TO_CHAR(A.TGL_CETAK,'MM/YYYY') = TO_CHAR(:UTAMA.PERIODE,'MM/YYYY'))
         // AND A.COA_ID IS NULL
         // )
         // GROUP BY NO_BUKTI;
            
    }


    /**
     * @function cekFaktur dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    private function cekFaktur($periode)
    {
        $data['bukti'] = DB::table('bi_keu.fa_kartu_hutang_bi_view a')
                        ->select(DB::raw('count(a.coa_id) total_coa'), 'a.no_bukti')
                        ->whereRaw("to_char(a.tgl_cetak,'mm/yyyy') = '".$periode."'")
                        ->whereNull('a.no_faktur')
                        ->groupBy('a.no_bukti')
                        ->get();

        return $data['bukti'];                
        // dd($data['bukti']);                
         // SELECT NO_BUKTI,
         //          COA_ID
         //     FROM   BI_KEU.FA_KARTU_HUTANG_BI_VIEW A
         // WHERE  (TO_CHAR(A.TGL_CETAK,'MM/YYYY') = TO_CHAR(:UTAMA.PERIODE,'MM/YYYY'))   --WHERE  (A.TGL_CETAK BETWEEN :UTAMA.FROM_DATE AND :UTAMA.TO_DATE)
         // AND        A.NO_FAKTUR IS NULL;
    }

    /**
     * @function getDetailTransfer dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    private function getDetailTransfer($periode)
    {
        DB::enableQueryLog();
        $data['bukti'] = DB::table('bi_keu.fa_pembayaran_mst')  
                            ->whereRaw("tgl_cetak between trunc(to_date('".$periode."','mm/yyyy'),'MM') and last_day(to_date('".$periode."','mm/yyyy'))")
                            ->select(DB::Raw('count(no_bukti) jmlbukti, nvl(sum(total),0) total'))
                            ->first();
        // dd(DB::getQueryLog());
        return $data['bukti'];                    
        // SELECT COUNT(*),SUM(NVL(TOTAL,0))
        // FROM BI_KEU.FA_PEMBAYARAN_MST
        // WHERE  TGL_CETAK BETWEEN TRUNC(:MAIN.PERIODE,'YYYY') AND LAST_DAY(:MAIN.PERIODE);

    }

}
