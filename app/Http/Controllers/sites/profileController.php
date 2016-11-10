<?php

namespace App\Http\Controllers\sites;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Validator;
use DB;
use Carbon;

class profileController extends Controller
{
    //

    /**
     * @function index dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function index()
    {
      return view('modules.sites.components.profile');
    }


    /**
     * @function changePassword dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    protected function changePassword(Request $request)
    {
        DB::enableQueryLog();
        // if($this->validationChangePassword($request)->fails())
        $request->offsetSet("f_nip_sys", Auth::user()->f_nip_sys);

        $validator = Validator::make($request->all(), [
            'f_nip_sys'         => 'required',
            'current_password'  => 'required|min:6',
            'password'          => 'required|min:6|confirmed',
            'password_confirmation'  => 'required|min:6',
        ]);

        // dd($validator->fails());
        if($validator->fails()) {
            // dd($validator->errors());
            return $validator->errors();
        }
        // dd(password_verify($request->current_password, Auth::user()->password));
        // dd(Auth::user()->password);
        // dd($this->authenticated($request, Auth::user()));

        if(password_verify($request->current_password, Auth::user()->password)){
            User::where([
                'f_nip_sys' => Auth::user()->f_nip_sys, 
                'email' => Auth::user()->email,
                ])
            ->update([
                'password' => bcrypt($request['password']),
                'sys_user_updated' => Auth::user()->f_nip_sys,
                'sys_tgl_updated' => Carbon::now(),
            ]); 
        // dd(DB::getQueryLog());
            return response(['type'=>'success', 'message'=>'Password Baru Berhasil Disimpan']);
        }
        else {
            return response(['type'=>'error', 'message'=>'password lama tidak sesuai']);
            // dd(false);
        }
    }


    /**
     * @function validationChangePassword dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    protected function validationChangePassword($request)
    {

        return $validator;
        // dd($validator);
        // User::
        
    }


}
