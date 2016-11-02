<?php

namespace App\Http\Requests\keu;

use App\Http\Requests\Request;
use App\Http\Models\keu\acc_cost_center as modelMst;


class reqKeuCostCenter extends Request
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
        //echo $this->get((new modelMst)->getKeyName());
        return [
            //'cost_id'           => 'unique:acc_cost_center,cost_id,'.$this->get((new modelMst)->getKeyName()).','.(new modelMst)->getKeyName(),  
            'cost_jenis'        => 'required',
            'cost_keterangan'   => 'required',
         ];
    }
}