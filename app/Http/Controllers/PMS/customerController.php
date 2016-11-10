<?php

namespace App\Http\Controllers\PMS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\pms\pms_customer_mst as modelMst;
use App\Http\Requests\reqPmsCustomerMst as reqMst;
use Carbon;
use DB;
use PDF;
use Excel;

class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    public function index(Request $request)
    {
        $sort  = 'nama_customer';

        $query = modelMst::with('coa')->where('sys_status_aktif','A');
        
        if(!empty($request->get('coa_id')) and $request->get('coa_id') !== 'undefined'){
            // dd($request->all());
            $query->whereNotNull('coa_id');
            $sort = 'coa_id';
        }

        if($request->get('search')){
            // $items = modelMst::where('sys_status_aktif','A')->where("nama_customer", "LIKE", "%".$request->get('search')."%")->paginate(5);      
            $query->where("nama_customer", "LIKE", "%".$request->get('search')."%");//->paginate(5);      
        }//else{
            // $items = modelMst::where('sys_status_aktif','A')->paginate(5);
            // $items = $query->paginate(5);
        // }
            $items = $query->orderBy($sort)->paginate(5);
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
    public function store(reqMst $request, modelMst $model)
    {
         $request->merge(array(
            'id_customer' => $this->generate_id(),
            'sys_user_update' => 'ADMIN',
        ));
         // dd($request->all());   

        $model->create($request->all());
        return $model->find($request->id_customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return modelMst::find($id);
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
    public function update(reqMst $request, modelMst $customer)
    {
        //
        // dd($request->all());
        // $abc->fill($request->all())->save();
        // return response($abc->find($id));
        // return response($abc->find($request->id_customer));
        $customer->fill($request->all())->save();
        return response($customer->find($request->id_customer));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        modelMst::where((new modelMst)->getKeyName(), $id)->update(['sys_status_aktif'=>'N']);        
    }

     /**
     * @function generate_id dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return id
     */
    public function _index(){
        return view('pms/customer');
    }


    /**
     * @function _pdfRekapCustomer dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function _RekapCustomer($fileType)
    {
        if(empty($fileType)) abort(403, 'unauthorized');

        $hasil['vData'] = modelMst::get();

        if($fileType == 'pdf'){   
            $pdf = PDF::loadView('pms.report.rpt-customer', $hasil);
            return $pdf->download('rekap customer.pdf');
            // $pdf = PDF::make('dompdf.wrapper');
            // $pdf = PDF::loadHTML('<h1>Test</h1>');
            // return $pdf->stream();
            // return view('pms.report.pdf.testPdf');
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

    /**
     * @function generate_id dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return id
     */
    private function generate_id(){
        $max_id = modelMst::where('id_customer','like','CST-%')->max('id_customer');
        return 'CST-'.(!empty($max_id) ? str_pad(((int)substr($max_id, strpos($max_id,'-')+1)+1),5,'0',STR_PAD_LEFT) : '00001'); 
    }

}
