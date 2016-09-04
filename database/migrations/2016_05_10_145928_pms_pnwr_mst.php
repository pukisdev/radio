<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class PmsPnwrMst extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pms_pnwr_mst', function (Blueprint $table) {
            $table->string('id_pnwr', 64)->primary();
            $table->string('no_po_customer', 256)->nullable();
            $table->string('f_customer',16);
            $table->string('judul_iklan', 256);
            $table->string('kepada', 64)->nullable();
            $table->string('f_ae', 16);
            $table->string('f_produk', 16);
            // $table->string('f_tarif', 8);
            $table->double('tarif', 15,2);
            $table->timestamp('tgl_penawaran')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('durasi',32);
            $table->tinyInteger('periode',false,true);
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
            // $table->tinyInteger('jml_periode',false,true);
            // $table->string('satuan_periode',32);
            $table->tinyInteger('frekuensi',false,true);
            $table->tinyInteger('total_tayang',false,true);
            $table->string('jenis_bayar',128);
            $table->double('tarif_normal',15,2);
            $table->double('tarif_diskon',15,2);
            $table->double('tarif_potongan',15,2);
            $table->double('tarif_hpp',15,2);
            $table->double('tarif_ppn',15,2);
            $table->double('tarif_total',15,2);
            $table->double('pnwr_hpp',15,2);
            $table->double('pnwr_ppn',15,2);
            $table->double('pnwr_total',15,2);
            $table->enum('pnwr_status', ['proses', 'order', 'batal']);
            $table->string('f_spks',32)->nullable();
            $table->string('keterangan',512);
            $table->string('sys_user_update',32);
            $table->timestamp('sys_tgl_update')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('sys_status_aktif')->default('A');
        });
        
        Schema::table('pms_pnwr_mst', function (Blueprint $table) {
            $table->foreign('f_customer')->references('id_customer')->on('pms_customer_mst');
            // $table->foreign('f_ae')->references('id_ae')->on('pms_ae_mst');
            $table->foreign('f_produk')->references('id_produk')->on('pms_produk_mst');
            // $table->foreign('f_tarif')->references('id_tarif')->on('pms_produk_tarif');
            // $table->foreign('f_spks')->references('id_spks')->on('hkm_spks_mst');
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pms_pnwr_mst');
    }
}
