<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Models\pms_produk_mst as modelMst;

class req_pms_produk_mst extends Request
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
        $primaryKey = (new modelMst)->getKeyName();
        return [
            //
            'id_produk' => 'unique:pms_produk_mst,id_produk,'.$this->get($primaryKey).','.$primaryKey,
            'nama' => 'required',//|unique:pms_produk_mst,nama',
            'durasi' => 'required',
            'satuan_durasi' => 'required',
            // 'sys_user_update' => 'required',
            // 'sys_tgl_update' =>,
            // 'sys_status_aktif');

        ];
    }

    /**
     * @function message dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return true
     */
    public function message()
    {
        //your script logic broo
        return [
            'id_produk.unique'=> 'Duplicate Entry',
            'nama.required'     => 'Kolom nama harus diisi',
            'durasi.required'   => 'Kolom email harus diisi',
            'satuan.required'   => 'Kolom kelas harus diisi',
        ];
    }

}
