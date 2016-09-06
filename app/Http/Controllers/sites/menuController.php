<?php

namespace App\Http\Controllers\sites;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\sys\sys_app_mst as modelMst;
use App\Http\Models\sys\sys_module_mst as module;
use Carbon;
use DB;

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
        $hasil['menu'] = modelMst::with(['module','type'])->where('f_type', strtoupper($jenis))->where('f_module', strtolower($module))->get();
        // dd(DB::getQueryLog());
        $varTemp = $hasil['menu']->all();
        $hasil['namaModule'] = $varTemp[0]->module->nama_module;
        $hasil['namaType'] = $varTemp[0]->type->nama_type;
        // dd($varTemp[0]->type->nama_type);
        // dd($apps->all());
        // return response($apps);
        // $apps[0]
        return view('modules/sites/components/menus', ['vData'=>$hasil]);
    }
}
