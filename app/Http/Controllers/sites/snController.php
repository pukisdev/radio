<?php

namespace App\Http\Controllers\sites;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class snController extends Controller
{
    //

    /**
     * @function index dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function index()
    {
    	// dd(Auth::check());
    	// return view('welcome');		
      return view('modules.sites.sn.home');
      // return view('modules.sites.sn.social_networking');
    }
}
