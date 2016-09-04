<?php

namespace App\Http\Controllers\PMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Http\Requests;

use App\Http\Models\pms\pms_produk_mst;
use App\Http\Requests\req_pms_produk_mst;
use Carbon;
use DB;

class produkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // DB::enableQueryLog();    
        
        if($request->get('search')){
            $items = pms_produk_mst::with(['tarif' => function($query){
                                            $query->where('sys_status_aktif','A');
                                        }])->where("nama", "LIKE", "%".$request->get('search')."%")->paginate(5);      
        }else{
            $items = pms_produk_mst::with(['tarif' => function($query){
                                            $query->where('sys_status_aktif','A');
                                        }])->paginate(5);
        }
        // $items = pms_produk_mst::with('tarif')->paginate(5);
    
        // if(!empty($request->lov)){   
        //     // $items->where('f_tarif','is not nulla','asdasdasd');
        // }             
        // } else {
            // return pms_produk_mst::orderBy('id_produk', 'asc')->get();
            // $input = $request->all();
            // dd($input);
        //     if($request->get('search')){
        //         // dd($request->get('search'));    
        //         // $items = pms_produk_mst::where("nama", "LIKE", "%{$request->get('search')}%")->get();//->paginate(5);      
        //         $items = pms_produk_mst::where("nama", "LIKE", "%".$request->get('search')."%")->paginate(5);      
        //     }else{
        //         $items = pms_produk_mst::paginate(5);
        //     }
        // }    

        // if(!empty($request->lov)){                
        //     $items->load(['tarif' => function ($query) {
        //         $query->where('sys_status_aktif','A')->first();
        //     }]);
        // }    

        // dd(DB::getQueryLog());   
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
    // public function store(Request $request)
    // public function store(Request $request, pms_produk_mst $produk)
    public function store(req_pms_produk_mst $request, pms_produk_mst $produk)
    {
        //
        $request->merge(array(
            'id_produk' => $this->generate_id(),
            'sys_user_update' => 'ADMIN'
        ));

        // dd($request->all());
        $produk->create($request->all());
        return $produk->find($request->id_produk);
        // $create = $produk->create($request->all());
        // return response($create);
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
        return pms_produk_mst::find($id);
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
    // public function update(Request $request, $id)
    public function update(pms_produk_mst $produk, req_pms_produk_mst $request)
    {
        // dd($request->id_produk);
        $produk->fill($request->all())->save();
        return response($produk->find($request->id_produk));
        // $hasil = response($produk->find($request->id_produk), array(
        //         'pesan' => 'berhasil berhasil hore'
        //     ));
        // $hasil->merge();
        //dd($hasil);
        // return $hasil;
        // return "Sucess updating user #" . $request->id_produk;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    public function destroy(pms_produk_mst $produk)
    {
        //
        $produk->delete();
        // $hasil = $produk->delete();
        // return response($hasil);
        // $delete = pms_produk_mst::find($id);
        // return $delete->delete();
    }



    /**
     * @function generate_id dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return id
     */
    public function _index(){
        return view('pms/produk');
    }

    /**
     * @function generate_id dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return id
     */
    private function generate_id(){
        // $data = pms_produk_mst::select('max(id_produk) as max_id')->where('id_produk','like','BRG-%')->first();
        $max_id = pms_produk_mst::where('id_produk','like','BRG-%')->max('id_produk');
        // dd($data->id_produk);
        // $max_id = $data;

        return 'BRG-'.(!empty($max_id) ? str_pad(((int)substr($max_id, strpos($max_id,'-')+1)+1),5,'0',STR_PAD_LEFT) : '00001'); 
    }

}
