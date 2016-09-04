<?php

namespace App\Http\Controllers\sites;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\sys\sys_app_mst as modelMst;
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
        $apps = modelMst::where('f_type', strtoupper($jenis))->where('f_module', strtolower($module))->get();
        dd(DB::getQueryLog());
        return response($apps);
    }
}
