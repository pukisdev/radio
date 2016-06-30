<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class reqPmsPnwrSpk extends Request
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
            'id_spk'                => 'unique:pms_pnwr_spk, id_spk',
            'f_pnwr'                => 'required',
            'pihak_pertama'         => 'required',
            'jabatan_pihak_pertama' => 'required',
            'pihak_kedua'           => 'required',
            'jabatan_pihak_kedua'   => 'required',
            'tgl_spk'               => 'required',
                                    
        ];
    }
}
