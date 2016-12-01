<?php

namespace App\Http\Controllers\pms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\pms\pms_pnwr_mst as modelMst;
use Carbon;
use DB;
use PDF;
use Excel;

class rekapStatusOrderController extends Controller
{
    //
    public function index(){
    	return view('pms.rekapStatusOrder');
    }

    public function _RekapStatusOrder($fileType, Request $request)
    {
        /*echo $fileType;
        echo $request['tgl_awal'];
        echo $request['tgl_akhir'];
        die();*/

        if(empty($fileType)) abort(403, 'unauthorized');
        //$from   = \DateTime::createFromFormat('D M d Y H:i:s e+', $request['tgl_awal']);
        $from   = Carbon::parse($request['tgl_awal']);
        $to     = Carbon::parse($request['tgl_akhir']);


        $hasil = modelMst::whereBetween('tgl_penawaran', array($from, $to))->get();

        if($fileType == 'pdf'){   
            $pdf = PDF::loadView('pms.report.rpt-status-order', ['vData' => $hasil, 'from' => $from, 'to' => $to ])->setPaper('a4', 'landscape');
            return $pdf->download('rekap customer.pdf');
        } else {
            //
            Excel::create('rekapCustomer', function($excel) use ($hasil) {

                // Set the title
                $excel->setTitle('Rekap Customer');

                // Chain the setters
                $excel->setCreator('rianday')->setCompany('pukisdev');

                // Call them separately
                $excel->setDescription('A demonstration to change the file properties');
                
                $excel->sheet('Sheetname', function($sheet) use ($hasil) {
                    $sheet->loadView('pms.report.rpt-customer', $hasil);                    
                });
            })->export('xls');            
        }
        
    }

}
