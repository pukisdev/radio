<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Models\pms_fp_mst as modelMst;

class reqPmsFpMst extends Request
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
            'id_fp'             => 'unique:pms_fp_mst,id_fp,'.$this->get((new modelMst)->getKeyName()).','.(new modelMst)->getKeyName(),
            //'generate_ke'       => 'required',
            'f_customer'        => 'required',
            'tgl_fp'            => 'required',
            'deskripsi_fp'      => 'required',
            // 'tgl_jatuh_tempo'   => 'required',
            'jenis_faktur'      => 'required',
            // 'keterangan'        => 'required',
            'ttd'               => 'required',
            'netto'             => 'required',
            // 'netto_terbilang'   => 'required',
        ];
    }
}
