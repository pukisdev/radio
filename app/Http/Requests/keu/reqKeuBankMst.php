<?php

namespace App\Http\Requests\keu;

use App\Http\Requests\Request;
use App\Http\Models\keu\fa_bank_mst as modelMst;


class reqKeuBankMst extends Request
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
            //'no'            => 'unique:fa_bank_mst,no,'.$this->get((new modelMst)->getKeyName()).','.(new modelMst)->getKeyName(),  
            //'coa_id_bank'   => 'unique:fa_bank_mst,coa_id_bank,'.$this->get('coa_id_bank').',coa_id_bank',
            'nama_bank'     => 'required',
            'no_acc'        => 'required',
            'plafon'        => 'numeric',
            'suku_bunga'    => 'numeric',
            'saldo_awal'    => 'numeric',
            'debet'         => 'numeric',
            'kredit'        => 'numeric',
        ];
    }
}

