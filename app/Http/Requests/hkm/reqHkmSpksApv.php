<?php

namespace App\Http\Requests\hkm;

use App\Http\Requests\Request;
// use App\Http\Models\hkm\hkm_spks_apv as modelMst;


class reqHkmSpksApv extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'f_spks'    => 'required',  
            'apv_nip'   => 'required',
        ];
    }
}
