<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PmsProdukTarif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pms_produk_tarif', function (Blueprint $table) {
            //
            $table->string('id_tarif', 8)->primary();
            $table->string('f_produk', 16);
            $table->bigInteger('harga', false, true);//->index();
            $table->string('satuan_durasi', 16);
            $table->string('sys_user_update',32);
            $table->timestamp('sys_tgl_update')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
            $table->string('sys_status_aktif')->default('A')->nullable();
        });

        Schema::table('pms_produk_tarif', function (Blueprint $table) {
            $table->foreign('f_produk')->references('id_produk')->on('pms_produk_mst');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pms_produk_tarif', function (Blueprint $table) {
            //
        });
    }
}
