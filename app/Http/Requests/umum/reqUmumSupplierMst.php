<?php

namespace App\Http\Requests\umum;

use App\Http\Requests\Request;
use App\Http\Models\umum\umum_supplier_mst as modelMst;

class reqPmsSupplierMst extends Request
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
            'id_supplier'   => 'unique:umum_supplier_mst,id_supplier,'.$this->get((new modelMst)->getKeyName()).','.(new modelMst)->getKeyName(),  
            'nama_supplier' => 'required'
        ];
    }
}
