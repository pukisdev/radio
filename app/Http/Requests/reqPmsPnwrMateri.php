<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class reqPmsPnwrMateri extends Request
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
            'f_pnwr'            => 'required',
            // 'materi_tayang'     => 'required',
            // 'materi_attach'     => 'required',
            // 'realisasi_produk'  => 'required',

        ];
    }
}
