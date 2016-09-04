<?php

namespace App\Http\Requests\hkm;

use App\Http\Requests\Request;
use App\Http\Models\hkm\hkm_spks_mst as modelMst;


class reqHkmSpksMst extends Request
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
            'id_spks'   => 'unique:hkm_spks_mst,id_spks,'.$this->get((new modelMst)->getKeyName()).','.(new modelMst)->getKeyName(),  
            'f_customer'=> 'required',
            'nama'      => 'required',
            // 'alias_spks'=> 'required',
        ];
    }
}
