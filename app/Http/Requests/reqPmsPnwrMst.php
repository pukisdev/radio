<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Models\pms_pnwr_mst as modelMst;

class reqPmsPnwrMst extends Request
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
            'id_pnwr'       => 'unique:pms_pnwr_mst,id_pnwr,'.$this->get((new modelMst)->getKeyName()).','.(new modelMst)->getKeyName(),
            // 'no_po_customer' => 'required',
            'f_customer'    => 'required',
            'judul_iklan'   => 'required',
            'kepada'        => 'required',
            'f_ae'          => 'required',
            'f_produk'      => 'required',
            // 'f_tarif'    => 'required',
            'tgl_penawaran' => 'required',
            'durasi'        => 'required',
            'periode'       => 'required',
            // 'jml_periode'   => 'required',
            // 'satuan_periode'=> 'required',
            'frekuensi'     => 'required',
            'total_tayang'  => 'required',
            'jenis_bayar'   => 'required',
            'tarif_normal'  => 'required',
            // 'tarif_diskon'   => 'required',
            // 'tarif_potongan' => 'required',
            'tarif_hpp'     => 'required',
            'tarif_ppn'     => 'required',
            'tarif_total'   => 'required',
            'pnwr_hpp'      => 'required',
            'pnwr_ppn'      => 'required',
            'pnwr_total'    => 'required',
            'pnwr_status'   => 'required',
            // 'keterangan' => 'required',
        ];
    }
}
