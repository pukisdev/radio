<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Models\pms_produk_tarif as modelMst;

class reqPmsProdukTarif extends Request
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
            //
            'id_tarif'  => 'unique:pms_produk_tarif,id_tarif,'.$this->get((new modelMst)->getKeyName()).','.(new modelMst)->getKeyName(),  
            'f_produk'  => 'required',
            'harga'     => 'required',
            'satuan_durasi' => 'required',
        ];
    }
}
