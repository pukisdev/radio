<?php

namespace App\Http\Controllers\PMS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\pms_produk_tarif;
use App\Http\Requests\reqPmsProdukTarif;
use Carbon;

class tarifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request, pms_produk_tarif $_model)
    public function store(reqPmsProdukTarif $request, pms_produk_tarif $tarif)
    {
        //
        $request->offsetUnset("produk");

        $request->merge(array(
            'id_tarif' => $this->generate_id(),
            'sys_user_update' => 'ADMIN'
        ));
        // dd($request->all());

        $tarif->where('f_produk', $request->f_produk)->whereNotIn('id_tarif', [$request->id_tarif])->update(['sys_status_aktif'=>'N']);
        
        $tarif->create($request->all());
        return $tarif->find($request->id_tarif);        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //
        $input = $request->all();
        if($request->get('by')=='produk'){
            $hasil = pms_produk_tarif::with('produk')->where('f_produk',$id)->where('sys_status_aktif','A')->get();
        }else {
            $hasil = pms_produk_tarif::find($id);
        }

        // dd($hasil->first());

        return (!empty($hasil->first()->id_tarif)) ? $hasil->first() :  $hasil;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @function generate_id dibuat dan dikembangkan oleh rianday.
     * @depok
     * @return id
     */
    private function generate_id(){
        $max_id = pms_produk_tarif::where('id_tarif','like','TRF-%')->max('id_tarif');
        return 'TRF-'.(!empty($max_id) ? str_pad(((int)substr($max_id, strpos($max_id,'-')+1)+1),4,'0',STR_PAD_LEFT) : '0001'); 
    }

}
