<?php

namespace App\Http\Controllers\HKM;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\hkm\hkm_spks_mst as modelMst;
use App\Http\Models\hkm\hkm_spks_apv as modelDet;
use App\Http\Models\sdm\sdm_pegawai_mst as pegawai;

use App\Http\Requests\hkm\reqHkmSpksMst as reqMst;

use DB;
use Input;
use File;
use Carbon;
use Auth;

class spksController extends Controller
{
    var $destinationPath;
    /**
     * @function __construct dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function __construct()
    {
        $this->destinationPath = storage_path() . '/app/public';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    public function index(Request $request)
    {
        // DB::enableQueryLog();    
        $query = modelMst::with('customer')->where('sys_status_aktif','A');
        if(!empty($request->f_customer)) $query->where('f_customer',$request->f_customer);

        if($request->get('search')){
            $items = $query->where("nama", "LIKE", "%".$request->get('search')."%")->paginate(5);      
        }else{
          $items = $query->orderBy('sys_tgl_created','desc')->paginate(5);
        }
        // dd($items);
        // dd(DB::getQueryLog());   
        // dd($request->f_customer);
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
     * @return \Illuminate\Http\m_responsekeys(conn, identifier)                                                        
     */
    public function store(reqMst $request, modelMst $model)
    {
        DB::enableQueryLog();    
        $draft  = $request->file('_draft');
        $spks  = $request->file('_spks');
        $destinationPath = storage_path() . '/app/public';

        if(!empty($draft)) 
        $draft->move($destinationPath.'/draft', $draft->getClientOriginalName());

        if(!empty($spks))
        $spks->move($destinationPath.'/spks', $spks->getClientOriginalName());

        // dd($request->all());

        // dd($request->offsetGet('draft'));
        $request->offsetSet("draft", !empty($draft) ? $draft->getClientOriginalName() : (!empty($request->draft) ? $request->draft : null));
        $request->offsetSet("spks", !empty($spks) ? $spks->getClientOriginalName() : (!empty($request->spks) ? $request->spks : null));

        if(empty($request->id_spks)){
            $id_spks = $this->generate_id();
            $request->merge([
                'id_spks'           => $id_spks,
                'alias_spks'        => $id_spks,
                'sys_user_created'  => Auth::user()->f_nip_sys,
            ]);
            $model->create($request->except(['_draft','_spks']));

            foreach ($request->apv as $key => $value) {
                $apv = new modelDet;
                $apv->f_spks    = $id_spks;
                $apv->apv_nip   = $value['apv_nip'];
                $apv->mandatori = $value['mandatori'];
                $apv->sys_user_created = Auth::user()->f_nip_sys;
                $apv->save();
            }
        }else {
            $id_spks = $request->id_spks;
            $isAvailable = $model->findOrFail($id_spks);
            
            if($isAvailable) {

                $request->merge([
                    'sys_user_updated'  => Auth::user()->f_nip_sys,
                    'sys_tgl_updated'  => Carbon::now(),
                ]);
                // dd($request->except(['_draft','_spks','apv','customer']));
                $model->where('id_spks',$id_spks)->update($request->except(['_draft','_spks','apv','customer','nama_customer','id_spks']));//->save();
                
                modelDet::where(['f_spks'=>$id_spks])->update([
                                                        // 'sys_status_aktif'=>'N', 
                                                        'sys_user_updated'  => Auth::user()->f_nip_sys,
                                                        'sys_tgl_updated'  => Carbon::now(),
                                                        ]);
            }
        }
        
        // dn(DB::getQueryLog());

        $hasil['master'] = $model::with('customer')->find($id_spks);
        $hasil['detail'] = modelDet::with('pegawai')->where(['f_spks'=> $id_spks, 'sys_status_aktif'=>'A'])->get();

        return response($hasil);

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
        $hasil['master'] = modelMst::with('customer')->find($id);
        $hasil['detail'] = modelDet::with('pegawai')->where(['f_spks'=>$id, 'sys_status_aktif'=>'A'])->get();
        // dd(response($hasil));
        return response($hasil);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, modelMst $customer)
    {
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
        return view('hkm/spks/tblSpks',['judul'=>'SPKS']);
    }


    /**
     * @function getDefaultApv dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function _getDefaultApv($id)
    {
        // DB::enableQueryLog();    
        $defaultApv = pegawai::whereIn('nip_sys', ['!@#QQ@Qwrqwerwq','sdfasd1234123$w'])->get();
        // dd(DB::getQueryLog());
        // dd($defaultApv);
        return response($defaultApv);
        
    }


    /**
     * @function getFile dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function _getFiles($dir, $fileName)
    {   
        if(file_exists($this->destinationPath.'/'.$dir.'/'.$fileName))     
        return response()->download($this->destinationPath.'/'.$dir.'/'.$fileName);//, $headers);
        else return 'file not found'; 
    }


    /**
     * @function _delFiles dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function _delFiles($id_spks, $dir, $fileName)
    {
        modelMst::where('id_spks',$id_spks)->update([$dir=>'']);            

        $hasil['master'] = modelMst::with('customer')->find($id_spks);
        $hasil['detail'] = modelDet::with('pegawai')->where(['f_spks'=> $id_spks, 'sys_status_aktif'=>'A'])->get();
        return response($hasil);
    }


    /**
     * @function _setApv dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function _setApv(Request $request, $id_spks)
    {
        DB::enableQueryLog();
        // dd($request->all());
        $query = modelDet::where(['f_spks'=>$id_spks, 'sys_status_aktif'=>'A']);

        if(Auth::user()->f_nip_sys !== '12345678910111213'){
            $query->where('apv_nip', Auth::user()->f_nip_sys);
        } else {
            $query->where('apv_nip', $request->apv_nip);
        }

        $query->update([
                        'apv_status'=>$request->jawaban, 
                        'apv_tgl'   =>Carbon::now(),
                        'komentar'  =>$request->komentar,
                        'sys_user_updated'=> Auth::user()->f_nip_sys,
                        'sys_tgl_updated' => Carbon::now()
                    ]);

        dd(DB::getQueryLog());
        return 'true';
    }
    /**
     * @function generate_id dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return id
     */
    private function generate_id(){
        $max_id = modelMst::where('id_spks','like','SPKS-'.date('Y-m').'-%')->max('id_spks');
        return 'SPKS-'.date('Y-m').'-'.(!empty($max_id) ? str_pad(((int)substr($max_id, strrpos($max_id,'-')+1)+1),5,'0',STR_PAD_LEFT) : '00001'); 
    }


}
