<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Models\pms_customer_mst as modelMst;

class reqPmsCustomerMst extends Request
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
            'id_customer'   => 'unique:pms_customer_mst,id_customer,'.$this->get((new modelMst)->getKeyName()).','.(new modelMst)->getKeyName(),  
            'nama_customer' => 'required'
        ];
    }
}
