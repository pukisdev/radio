<?php

namespace App\Http\Controllers\acc;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\acc\acc_faktur_piutang as modelMst;
use App\Http\Models\acc\acc_faktur_piutang_sa as fakturPiutangSa;

use Carbon;
use DB;

class fakturHutangController extends Controller
{

    /**
     * @function _lovFakturPiutang dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function _lovFakturHutang(Request $request)
    {
        DB::enableQueryLog();
/*SELECT ALL A.NO_FAKTUR,A.COA_ID,((NVL(A.TOTAL,0)-NVL(A.BAYAR,0)-NVL(A.DEBET,0)+NVL(A.KREDIT,0))-NVL(C.BAYAR,0)) SISA_PIUTANG,A.CURRENCY
FROM bi_acc.acc_faktur_hutang a,bi_acc.acc_coas_mst b,bi_keu.fa_pembayaran_kwitansi_v C
WHERE a.coa_id = b.coa_id AND
      A.NO_FAKTUR = C.NO_FAKTUR (+) 
      --AND A.COA_ID LIKE :COA_ID||'%'
ORDER BY A.NO_FAKTUR ASC*/

        $query = DB::table('bi_acc.acc_faktur_hutang a')
                    ->join('bi_acc.acc_coas_mst b','a.coa_id', '=', 'b.coa_id')
                    ->leftJoin('bi_keu.fa_pembayaran_kwitansi_v c','a.no_faktur','=','c.no_faktur')
                    ->select('A.NO_FAKTUR','a.TGL_FAKTUR','A.COA_ID','((NVL(A.TOTAL,0)-NVL(A.BAYAR,0)-NVL(A.DEBET,0)+NVL(A.KREDIT,0))-NVL(C.BAYAR,0)) SISA_HUTANG','A.CURRENCY');

        if($request->get('search')){
            $query->where("a.no_faktur", "LIKE", "%".$request->get('search')."%");
        }

        if($request->get('coa_id')){
            $query->where("((NVL(A.TOTAL,0)-NVL(A.BAYAR,0)-NVL(A.DEBET,0)+NVL(A.KREDIT,0))-NVL(C.BAYAR,0))", ">", 0);
            $query->where("a.coa_id", "=", $request->get('coa_id'));
        }

        $items = $query->orderBy('a.tgl_faktur')->paginate(5);
        // dd(DB::getQueryLog());    
        // dd($faktur);
        return response($items);        
    }
}
