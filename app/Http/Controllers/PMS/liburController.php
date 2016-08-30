<?php

namespace App\Http\Controllers\PMS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\pms\pms_tgl_libur_mst;
use App\Http\Requests\reqPmsTglLiburMst;
use Carbon;
use DB;

class liburController extends Controller
{
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // dd((new pms_tgl_libur_mst)->getKeyName());
        // $input = $request->all();

        if($request->get('search')){
            // $items = pms_tgl_libur_mst::where("id_tanggal", "LIKE", "%".$request->get('search')."%")->paginate(5);      
            // $items = pms_tgl_libur_mst::where("id_tanggal", Carbon::createFromDate('Y-m-d',$request->get('search')))->paginate(5);      
          $items = pms_tgl_libur_mst::paginate(5);
        }else{
          $items = pms_tgl_libur_mst::paginate(5);
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
    public function store(reqPmsTglLiburMst $request, pms_tgl_libur_mst $libur)
    {
         $request->merge(array(
            'sys_user_update' => 'ADMIN',
            // 'id_tanggal'    => Carbon::createFromDate$request->id_tanggal)
        ));
         // dd($request->all());   
        
        $libur->create($request->all());
        // return $libur->find($request->id_tanggal);
        return $libur->find($request->id_tanggal);
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
        return pms_tgl_libur_mst::find($id);
        // dd(pms_tgl_libur_mst::find($id));
        // print_r(DB::getQueryLog());
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
    // public function update(reqPmsTglLiburMst $libur, Request $request)
    public function update(reqPmsTglLiburMst $request, pms_tgl_libur_mst $libur)
    {
        // dd($request->all());
        $libur->fill($request->all())->save();
        return response($libur->find($request->id_tanggal));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    public function destroy(pms_tgl_libur_mst $libur)
    {
        //
        $libur->delete();
        // DB::enableQueryLog();    
        // pms_tgl_libur_mst::where('id_tanggal', $id)->update(['sys_status_aktif'=>'N']);        
        // print_r(DB::getQueryLog());   
    }

     /**
     * @function generate_id dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return id
     */
    public function _index(){
        return view('pms/libur');
        // return view('pms/customer');
    }

    /**
     * @function generate_id dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return id
     */
    // private function generate_id(){
    //     $max_id = pms_tgl_libur_mst::where('id_tanggal','like','BRG-%')->max('id_tanggal');
    //     return 'BRG-'.(!empty($max_id) ? str_pad(((int)substr($max_id, strpos($max_id,'-')+1)+1),5,'0',STR_PAD_LEFT) : '00001'); 
    // }
}
