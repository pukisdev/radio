<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Models\pms_tgl_libur_mst as modelMst;

class reqPmsTglLiburMst extends Request
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
            'tanggal'   => 'date|date_format:Y-n-j|unique:pms_tgl_libur_mst,tanggal,'.$this->get((new modelMst)->getKeyName()).','.(new modelMst)->getKeyName(),  
            'deskripsi' => 'required',
        ];
    }
}
