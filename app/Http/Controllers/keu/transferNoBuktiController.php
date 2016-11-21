<?php

namespace App\Http\Controllers\keu;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use App\Http\Models\keu\fa_fpajak_mst_nomor as ModelMst;

use Carbon;
use DB;
use Validator;

class transferNoBuktiController extends Controller
{
    var $allowedTransfer;
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index(Request $request)
    // {
    //     //
    //     if($request->get('search')){
    //         $items = modelMst::where("no_bukti", "LIKE", "%".$request->get('search')."%")
    //                  //->where("status_aktif","=","A")
    //                  ->orderBy('tanggal','desc')->paginate(5);      
    //     }else{
    //       //$items = modelMst::where("status_aktif","=","A")->paginate(5);
    //       $items = modelMst::orderBy('tanggal','desc')->paginate(5);
    //     }
    //     // dd($items);
    //     return response($items);
    // }

    function __construct()
    {
        $this->$allowedTransfer = false;
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
        $this->cancelArGl($periode);
        $this->postingGPenerimaanDua($periode);
        $this->balancingFaktur($periode);
    }
 


    /**
     * @function postingGPenerimaanDua dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function postingGPenerimaanDua($periode)
    {
        // CURSOR C_NP_MST IS   
        // select a.lks,
        //       a.no_bukti,
        //       a.tgl_terima,
        //       nvl(a.total,0),
        //       a.keterangan
        // from     bi_keu.fa_penerimaan_mst a
        // where  a.tgl_terima between trunc(:main.periode,'mm') and last_day(:main.periode);
        
        $data['cNpMst'] = DB::table('bi_keu.fa_penerimaan_mst a')
                            ->select(DB:raw('a.lks, a.no_bukti, a.tgl_terima,nvl(a.total,0) total, keterangan'))
                            ->whereRaw("tgl_terima between trunc(to_date('".$periode."','mm/yyyy'),'MM') and last_day(to_date('".$periode."','mm/yyyy'))");

        // CURSOR C_NP_DET IS   
        // SELECT A.NO_BUKTI,
        //       A.COA_ID,
        //       A.CURRENCY_ID,
        //       A.TIPE,
        //       A.NILAI,
        //       B.LKS,
        //       A.KETERANGAN
        // FROM     BI_KEU.FA_PENERIMAAN_MST B,BI_KEU.FA_PENERIMAAN_JURNAL_VIEW A
        // WHERE    B.NO_BUKTI = A.NO_BUKTI 
        // AND    B.TGL_TERIMA BETWEEN TRUNC(:MAIN.PERIODE,'MM') AND LAST_DAY(:MAIN.PERIODE);

        $data['cNpDet'] = DB::table('bi_keu.fa_penerimaan_mst b')
                            ->join('bi_keu.fa_penerimaan_jurnal_view a','b.no_bukti','=','a.no_bukti')
                            ->select('a.no_bukti','a.coa_id','a.currency_id','a.tipe','a.nilai','b.lks','a.keterangan')
                            ->whereRaw("b.tgl_terima between trunc(to_date('".$periode."','mm/yyyy'),'MM') and last_day(to_date('".$periode."','mm/yyyy'))");
 
        // CURSOR C_KAR IS   
        // SELECT NO_BUKTI,
        //           COA_ID,
        //           NO_FAKTUR,
        //             CURRENCY_ID,
        //           KETERANGAN,
        //             NILAI_BAYAR,
        //             TGL_CETAK
        // FROM   BI_KEU.FA_KARTU_PIUTANG_BI_VIEW A
        // WHERE  A.TGL_CETAK BETWEEN TRUNC(:MAIN.PERIODE,'MM') AND LAST_DAY(:MAIN.PERIODE);
        $data['kar'] = DB::table('bi_keu.fa_kartu_piutang_bi_view a')
                        ->select('no_bukti','coa_id','no_faktur','currency_id','keterangan','nilai_bayar','tgl_cetak')
                        ->whereRaw("tgl_cetak between trunc(to_date('".$periode."','mm/yyyy'),'MM') and last_day(to_date('".$periode."','mm/yyyy'))");
    

// CURSOR C_KARTU_HUTANG IS   
//        SELECT NO_BUKTI,
//                   COA_ID,
//                   NO_INVOICE,
//                     CURRENCY_ID,
//                   KETERANGAN,
//                     NILAI_BAYAR,
//                     TGL_TERIMA
//            FROM   BI_KEU.FA_KARTU_HUTANG_PENERIMAAN_V A
//            WHERE  A.TGL_TERIMA BETWEEN TRUNC(:MAIN.PERIODE,'MM') AND LAST_DAY(:MAIN.PERIODE);
        $data['cKartuHutang'] = DB::table('bi_keu.fa_kartu_hutang_penerimaan_v')      
     
// CURSOR C_FAK IS   
//        SELECT TRIM(A.NO_FAKTUR) NO_FAKTUR,
//               A.CURRENCY_ID,
//               SUM(A.NILAI_BAYAR) NILAI_BAYAR
//         FROM    FA_PENERIMAAN_AR_DET A,FA_PENERIMAAN_MST B
//             WHERE A.NO_BUKTI = B.NO_BUKTI 
//         AND   B.TGL_TERIMA BETWEEN TRUNC(:MAIN.PERIODE,'MM') AND LAST_DAY(:MAIN.PERIODE)
//         GROUP BY A.NO_FAKTUR,
//                      A.CURRENCY_ID;
                       
     
CURSOR C_SAL IS   
       SELECT B.COA_CUSTOMER,
              SUM(B.NILAI_BAYAR) TOTAL,
              'K'||TO_CHAR(TO_NUMBER(TO_CHAR(A.TGL_TERIMA,'mm'))),
              TO_CHAR(A.TGL_TERIMA,'yyyy')
        FROM    BI_KEU.FA_PENERIMAAN_MST A,BI_KEU.FA_PENERIMAAN_AR_DET B
        WHERE A.NO_BUKTI = B.NO_BUKTI --AND
              --A.NO_BUKTI = XNO_BUKTI;
              --  AND B.COA_CUSTOMER  ='1.1.03.06.I0005'
        AND   A.TGL_TERIMA BETWEEN TRUNC(:MAIN.PERIODE,'MM') AND LAST_DAY(:MAIN.PERIODE)
        --AND   TO_CHAR(A.TGL_TERIMA,'MM/YYYY') = TO_CHAR(:MAIN.PERIODE,'YYYY')  --(A.TGL_TERIMA BETWEEN :MAIN.FROM_DATE AND :MAIN.TO_DATE) 
        --AND   A.POSTING LIKE '0'
        AND     B.COA_CUSTOMER IS NOT NULL
        GROUP BY B.COA_CUSTOMER,
                 'K'||TO_CHAR(TO_NUMBER(TO_CHAR(A.TGL_TERIMA,'mm'))),
                 TO_CHAR(A.TGL_TERIMA,'yyyy');            

                         
CURSOR C_SET_MST IS                     
       SELECT A.NO_BUKTI,
              A.TGL_CETAK,
              A.JUMLAH,
              A.KETERANGAN
         FROM   FA_SETORAN_BANK_MST A
         WHERE  A.TGL_CETAK BETWEEN TRUNC(:MAIN.PERIODE,'MM') AND LAST_DAY(:MAIN.PERIODE);
         --WHERE TO_CHAR(A.TGL_CETAK,'MM/YYYY') = TO_CHAR(:MAIN.PERIODE,'YYYY');   --(A.TGL_CETAK BETWEEN :MAIN.FROM_DATE AND :MAIN.TO_DATE) 
       --AND A.POSTING LIKE '0';
                
CURSOR C_SET_DET IS  
       SELECT B.COA_ID,
                    B.NO_BUKTI,
                    B.DEBET,
                    B.KREDIT,
                    B.KETERANGAN
           FROM     FA_SETORAN_BANK_MST A, FA_SETORAN_BANK_JURNAL_DET B
             WHERE  A.NO_BUKTI =B.NO_BUKTI
             AND    A.TGL_CETAK BETWEEN TRUNC(:MAIN.PERIODE,'MM') AND LAST_DAY(:MAIN.PERIODE);
             --AND      TO_CHAR(A.TGL_CETAK,'MM/YYYY') = TO_CHAR(:MAIN.PERIODE,'YYYY');  --(A.TGL_CETAK BETWEEN :MAIN.FROM_DATE AND :MAIN.TO_DATE) 
         --AND      A.POSTING LIKE '0';
     


    }

    /**
     * @function cancleArGl dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    private function cancelArGl($periode)
    {        
          // --******** HAPUS DATA PENERIMAAN KAS BANK PADA G/L *************
        // $sub['bukti'] = DB::table('bi_acc.acc_gl_trans_mst')
        //                 ->select('bukti')
        //                 ->whereIn('jurnal',['01','03','05','07'])
        //                 ->whereRaw("tgl_terima between trunc(to_date('".$periode."','mm/yyyy'),'MM') and last_day(to_date('".$periode."','mm/yyyy'))")
        //                 ->toSql();

        DB::table('bi_acc.acc_gl_trans_det')
            // ->whereIn('bukti', $sub['bukti'])
            ->whereIn('bukti', function($query) use ($periode) {
                    $query->select('bukti')
                        ->from('bi_acc.acc_gl_trans_mst')
                        ->whereRaw("tgl between trunc(to_date('".$periode."','mm/yyyy'),'MM') and last_day(to_date('".$periode."','mm/yyyy'))")
                        ->whereIn('jurnal',['01','03','05','07']);
            })
            ->delete();

        DB::table('bi_acc.acc_gl_trans_mst')
            ->whereIn('jurnal',['01','03','05','07'])
            ->whereRaw("tgl between trunc(to_date('".$periode."','mm/yyyy'),'MM') and last_day(to_date('".$periode."','mm/yyyy'))")
            ->delete();

          // --******** HAPUS DATA PENERIMAAN KAS BANK PADA KARTU PIUTANG *************
        DB::table('bi_acc.acc_kartu_piutang')
            ->whereIn('DK','K')
            ->whereRaw("SUBSTR(NO_BUKTI,1,2) IN ('BM','KM','GM')")
            ->whereRaw("tgl between trunc(to_date('".$periode."','mm/yyyy'),'MM') and last_day(to_date('".$periode."','mm/yyyy'))")
            ->delete();

          // --******** HAPUS DATA PENERIMAAN KAS BANK PADA KARTU HUTANG *************
        DB::table('bi_acc.acc_kartu_hutang')
            ->where('DK','D')
            ->whereRaw("SUBSTR(NO_BUKTI,1,2) IN ('BM','KM','GM')")
            ->whereRaw("tgl between trunc(to_date('".$periode."','mm/yyyy'),'MM') and last_day(to_date('".$periode."','mm/yyyy'))")
            ->delete();

    }



    /**
     * @function balancingFaktur dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function balancingFaktur($periode)
    {
        
    // --************* UPDATE BAYAR MULAI DARI TGL AWAL TAHUN S/D TGL AKHIR BULAN BERSANGKUTAN *******************
        DB::table('bi_acc.acc_faktur_piutang')
            ->whereIn('no_faktur', function($query) use ($periode){
                $table->distinct('a.no_faktur')
                    ->from('bi_keu.fa_penerimaan_ar_det a')
                    ->join('bi_keu.fa_penerimaan_mst b','a.no_bukti','=','b.no_bukti')
                    ->whereRaw("tgl_terima between trunc(to_date('".$periode."','mm/yyyy'),'YYYY') and last_day(to_date('".$periode."','mm/yyyy'))");
            })->update('bayar',0);

        // UPDATE BI_ACC.ACC_FAKTUR_PIUTANG
        // SET BAYAR=0
        // WHERE NO_FAKTUR IN (
        //             SELECT DISTINCT A.NO_FAKTUR   --,B.TGL_TERIMA 
        //             FROM BI_KEU.FA_PENERIMAAN_AR_DET A, BI_KEU.FA_PENERIMAAN_MST B
        //             WHERE  A.NO_BUKTI = B.NO_BUKTI
        //             AND    B.TGL_TERIMA BETWEEN TRUNC(:MAIN.PERIODE,'YYYY') AND LAST_DAY(:MAIN.PERIODE)
        // );
        
        DB::table('bi_acc.acc_faktur_piutang')
            ->whereRaw("tgl_terima between trunc(to_date('".$periode."','mm/yyyy'),'YYYY') and last_day(to_date('".$periode."','mm/yyyy'))")
            ->update('bayar',0);            
        // UPDATE BI_ACC.ACC_FAKTUR_PIUTANG
        // SET      BAYAR=0
        // WHERE  TGL_FAKTUR BETWEEN TRUNC(:MAIN.PERIODE,'YYYY') AND LAST_DAY(:MAIN.PERIODE);
        
    
    
    // --************** MASUKKAN SALDO AWAL KE FIELD 'BAYAR' **********************
        $data['faktur_sa'] = DB::table('bi_acc.acc_faktur_piutang_sa')->where('sa_tahun',substr($periode,2))->get();

        foreach ($data['faktur_sa'] as $key => $value) {
            DB::table('bi_acc.acc_faktur_piutang')
                ->where('no_faktur',$value->no_faktur)
                ->update('bayar',$value->bayar);
        }            
    // FOR REC IN (SELECT * FROM BI_ACC.ACC_FAKTUR_PIUTANG_SA
    //             WHERE SA_TAHUN =  TO_CHAR(:MAIN.PERIODE,'YYYY')) LOOP
    //     BEGIN
    //       UPDATE BI_ACC.ACC_FAKTUR_PIUTANG
    //       SET BAYAR=REC.BAYAR
    //       WHERE RTRIM(NO_FAKTUR) = RTRIM(REC.NO_FAKTUR);
            
    // END LOOP;
    
    // --************** TAMBAHKAN DENGAN TRANSAKSI DARI TGL AWAL TAHUN S/D TGL AKHIR BULAN BERSANGKUTAN  **************
        $data['ar_det'] = DB::table('bi_keu.fa_penerimaan_ar_det')
                        ->whereIn('no_bukti', function($query) use ($periode){
                            $query->select('no_bukti')
                                ->from('bi_keu.fa_penerimaan_mst')
                                ->whereRaw("tgl_terima between trunc(to_date('".$periode."','mm/yyyy'),'YYYY') and last_day(to_date('".$periode."','mm/yyyy'))");
                        })
                        ->get();

        foreach ($data['ar_det'] as $key => $value) {
            DB::table('bi_acc.acc_faktur_piutang')
                ->where('no_faktur',$value->no_faktur)
                ->update('bayar',DB::raw('nvl(bayar,0) + '.$value->nilai_bayar));
        }            
            // FOR REC_FAKTUR IN (SELECT *
            //                          FROM   BI_KEU.FA_PENERIMAAN_AR_DET
            //                          WHERE  NO_BUKTI IN (
            //                                 SELECT NO_BUKTI
            //                                   FROM   BI_KEU.FA_PENERIMAAN_MST
            //                                   WHERE  TGL_TERIMA BETWEEN TRUNC(:MAIN.PERIODE,'YYYY') AND LAST_DAY(:MAIN.PERIODE)
            //                    )) LOOP
            // BEGIN
            //     UPDATE BI_ACC.ACC_FAKTUR_PIUTANG
            //     SET    BAYAR = NVL(BAYAR,0) + REC_FAKTUR.NILAI_BAYAR
            //     WHERE  RTRIM(NO_FAKTUR) = RTRIM(REC_FAKTUR.NO_FAKTUR);
                    
            // END LOOP;

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
        $data['coa1'] = DB::table('bi_keu.fa_kartu_piutang_bi_view a')
                        ->select(DB::raw('count(a.coa_id) as total_coa'), 'a.no_bukti')
                        ->whereNull('a.coa_id')
                        ->whereRaw("to_char(a.tgl_cetak,'mm/yyyy') = '".$periode."'")
                        ->groupBy('a.no_bukti');

        $data['coa'] = DB::table('bi_keu.fa_penerimaan_mst b')
                        ->join('bi_keu.fa_penerimaan_jurnal_view a','b.no_bukti','=','a.no_bukti')
                        ->select(DB::raw('count(a.coa_id) as total_coa'), 'a.no_bukti')
                        ->where('b.posting','=','0')
                        ->whereNull('a.coa_id')
                        ->whereRaw("to_char(b.tgl_terima,'mm/yyyy') = '".$periode."'")
                        ->groupBy('a.no_bukti')
                        ->union($data['coa1'])
                        ->get();

        return $data['coa'];
        // dd(DB::getQueryLog());
        // dd($data['coa2']);
        // $select = '';

         // SELECT COUNT(COA_ID) COA_ID, NO_BUKTI
         // FROM (
         //             SELECT A.NO_BUKTI, A.COA_ID
         //             FROM   BI_KEU.FA_PENERIMAAN_MST B,BI_KEU.FA_PENERIMAAN_JURNAL_VIEW A
         //             WHERE  B.NO_BUKTI = A.NO_BUKTI 
         //       AND    B.POSTING LIKE '0' 
         //       AND    A.COA_ID IS NULL 
         //       AND    (TO_CHAR(B.TGL_TERIMA,'MM/YYYY') = TO_CHAR(:UTAMA.PERIODE,'MM/YYYY'))       --(B.TGL_TERIMA BETWEEN :UTAMA.FROM_DATE AND :UTAMA.TO_DATE)
         // UNION ALL
         //     SELECT A.NO_BUKTI, A.COA_ID 
         // FROM BI_KEU.FA_KARTU_PIUTANG_BI_VIEW A
         // WHERE (TO_CHAR(A.TGL_CETAK,'MM/YYYY') = TO_CHAR(:UTAMA.PERIODE,'MM/YYYY'))  --(A.TGL_CETAK BETWEEN :UTAMA.FROM_DATE AND :UTAMA.TO_DATE)
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
        $data['bukti'] = DB::table('bi_keu.fa_kartu_piutang_bi_view a')
                        ->select(DB::raw('count(a.coa_id) total_coa'), 'a.no_bukti')
                        ->whereRaw("to_char(a.tgl_cetak,'mm/yyyy') = '".$periode."'")
                        ->whereNull('a.no_faktur')
                        ->groupBy('a.no_bukti')
                        ->get();

        // dd($data['bukti']);                
        return $data['bukti'];                
        // SELECT A.NO_BUKTI, A.COA_ID 
        //       FROM BI_KEU.FA_KARTU_PIUTANG_BI_VIEW A
        //       WHERE (TO_CHAR(A.TGL_CETAK,'MM/YYYY') = TO_CHAR(:UTAMA.PERIODE,'MM/YYYY')) --(A.TGL_CETAK BETWEEN :UTAMA.FROM_DATE AND :UTAMA.TO_DATE)
        //                  AND A.NO_FAKTUR IS NULL        
    }

    /**
     * @function getDetailTransfer dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    private function getDetailTransfer($periode)
    {
        DB::enableQueryLog();
        $data['bukti'] = DB::table('bi_keu.fa_penerimaan_mst')  
                            ->whereRaw("tgl_terima between trunc(to_date('".$periode."','mm/yyyy'),'MM') and last_day(to_date('".$periode."','mm/yyyy'))")
                            ->select(DB::Raw('count(no_bukti) jmlbukti, nvl(sum(total),0) total'))
                            ->first();
        // dd(DB::getQueryLog());
        return $data['bukti'];                    
        // SELECT COUNT(*),SUM(NVL(TOTAL,0))
        // INTO     :MAIN.POSTED,:MAIN.DEBET
        // FROM     BI_KEU.FA_PENERIMAAN_MST
        // WHERE  TGL_TERIMA BETWEEN TRUNC(:MAIN.PERIODE,'MM') AND LAST_DAY(:MAIN.PERIODE);

    }

    public function _index(){
        return view('modules.keu.transferNoBukti');
    }

}
