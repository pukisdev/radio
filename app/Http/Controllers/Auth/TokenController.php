<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;

class TokenController extends Controller
{

    /**
     * @function getToken dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function getToken()
    {
        // dd(response(['token'=>Auth::user()->remember_token, 'e'=>base64_encode(Auth::user()->email)]));
        if(!Auth::check()) return response('Unauthorized.', 401);
        return response(['token'=>Auth::user()->remember_token, 'e'=>base64_encode(Auth::user()->email), 'url' => env('APP_API')] );
    }

}
