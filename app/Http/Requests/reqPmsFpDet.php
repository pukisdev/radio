<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class reqPmsFpDet extends Request
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
            'f_fp'              => 'required',
            'f_pnwr'            => 'required',
            'total_biaya'       => 'required',
            // 'nilai_biaya_persen' => 'required',
            'nilai_biaya'       => 'required',
            // 'nilai_potongan_persen'  => 'required',
            'nilai_potongan'    => 'required',
            'nilai_hpp'         => 'required',
            'nilai_ppn'         => 'required',
            'nilai_akhir'       => 'required',
        ];     
    }
}
