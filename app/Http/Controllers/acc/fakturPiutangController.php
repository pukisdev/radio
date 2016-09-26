<?php

namespace App\Http\Controllers\acc;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use App\Http\Models\acc\acc_faktur_piutang as modelMst;
// use App\Http\Models\acc\acc_faktur_piutang_sa as fakturPiutangSa;

use Carbon;
use DB;

class fakturPiutangController extends Controller
{

    /**
     * @function _lovFakturPiutang dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function _lovFakturPiutang(Request $request)
    {
        DB::enableQueryLog();

        // $first  = DB::table('bi_acc.acc_faktur_piutang a')->select('A.NO_FAKTUR','A.TGL_FAKTUR','A.COA_ID','((NVL(A.TOTAL,0)-NVL(A.BAYAR,0)+NVL(A.DEBET,0)-NVL(A.KREDIT,0)+NVL(A.PENYESUAIAN,0))) SISA_PIUTANG', 'A.CURRENCY')
        //     ->whereBetween('tgl_faktur',[Carbon::parse('01-01-'.date('Y H:s:i')), Carbon::parse('31-12-'.date('Y H:s:i'))]);

        // $second = DB::table('bi_acc.acc_faktur_piutang_sa b')->select('B.NO_FAKTUR','B.TGL_FAKTUR','B.COA_ID','((NVL(B.TOTAL,0)-NVL(B.BAYAR,0)+NVL(B.DEBET,0)-NVL(B.KREDIT,0)+NVL(B.PENYESUAIAN,0))) SISA_PIUTANG','B.CURRENCY')
        //     ->where('B.SA_TAHUN',Date('Y'));

        // if($request->get('search')){
        //     $first->where("no_faktur", "LIKE", "%".$request->get('search')."%");      
        //     $second->where("no_faktur", "LIKE", "%".$request->get('search')."%");      
        // } 

        // $items = $second->union($first)//->orderBy('a.no_faktur','asc')
        //             //->get();
        //         ->paginate(5);

        /*
            create view bi_acc.vsisa_faktur_piutang as
            SELECT ALL A.NO_FAKTUR,A.TGL_FAKTUR,A.COA_ID,((NVL(A.TOTAL,0)-NVL(A.BAYAR,0)+NVL(A.DEBET,0)-NVL(A.KREDIT,0)+NVL(A.PENYESUAIAN,0))) SISA_PIUTANG,A.CURRENCY
            FROM BI_ACC.ACC_FAKTUR_PIUTANG A
            WHERE   TO_CHAR(A.TGL_FAKTUR,'YYYY')=TO_CHAR(SYSDATE,'YYYY')
            UNION ALL 
            SELECT ALL B.NO_FAKTUR,B.TGL_FAKTUR,B.COA_ID,((NVL(B.TOTAL,0)-NVL(B.BAYAR,0)+NVL(B.DEBET,0)-NVL(B.KREDIT,0)+NVL(B.PENYESUAIAN,0))) SISA_PIUTANG,B.CURRENCY
            FROM BI_ACC.ACC_FAKTUR_PIUTANG_SA B
            WHERE   B.SA_TAHUN=TO_CHAR(SYSDATE,'YYYY')
            order by coa_id;
        */
        $query = DB::table('bi_acc.vsisa_faktur_piutang');

        if($request->get('search')){
            $query->where("no_faktur", "LIKE", "%".$request->get('search')."%");
        }

        if($request->get('coa_id')){
            $query->where("coa_id", "=", $request->get('coa_id'));
        }

        $items = $query->orderBy('tgl_faktur','desc')->paginate(5);
        // dd(DB::getQueryLog());    
        // dd($faktur);
        return response($items);        
    }
}
