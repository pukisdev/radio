<?php

namespace App\Http\Controllers\sites;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\sys\sys_app_mst as modelMst;
use App\Http\Models\sys\sys_module_mst as module;
// use App\Http\Models\sys\sys_akses_user_det as akses_det;
use Carbon;
use DB;
use Auth;

class menuController extends Controller
{
    //

    /**
     * @function index dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function index($jenis, $module)
    {
        DB::enableQueryLog();
        // dd($jenis.'/'.$module);
        // return view($jenis.'/'.$module);
        $hasil['menu'] = modelMst::with([/*'akses' => function($query){ $query->where('f_user',Auth::user()->f_nip_sys); },*/'module','type'])
                        ->where('f_type', strtoupper($jenis))
                        ->where('f_module', strtolower($module))
                        ->join('sys_user_akses_det', 'id_app','=','f_app')
                        //->whereIn('id_app', akses_det::)
                        // ->where('f_user', Auth::user()->f_nip_sys)
                        ->get();

        // dd(DB::getQueryLog());
        $varTemp = $hasil['menu']->all();
        
        // dd(url()->current());
        // dd(url()->previous());
        // dd(url()->full());
        // abort_if(empty($varTemp), 401);
        if(empty($varTemp))
            return response('Unauthorized.', 401);            
            // return abort(401, 'Unauthorized.');
            // return back();
        // return null;
        
        $hasil['namaModule'] = $varTemp[0]->module->nama_module;
        $hasil['namaType'] = $varTemp[0]->type->nama_type;
        // dd($varTemp[0]->type->nama_type);
        // dd($apps->all());
        // return response($apps);
        // $apps[0]
        return view('modules/sites/components/menus', ['vData'=>$hasil]);
    }
}
