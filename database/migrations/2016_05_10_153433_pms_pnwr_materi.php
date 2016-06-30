<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PmsPnwrMateri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pms_pnwr_materi', function (Blueprint $table) {
            $table->string('f_pnwr',64);
            $table->string('materi_tayang', 4000);
            $table->string('materi_attach', 256)->nullable();
            $table->string('realisasi_produk', 256)->nullable();
            $table->string('sys_user_update',32);
            $table->timestamp('sys_tgl_update')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('sys_status_aktif')->default('A');
            // $table->unique('f_pnwr, tayang_tgl');
        });
        
        Schema::table('pms_pnwr_materi', function (Blueprint $table) {
            $table->foreign('f_pnwr')->references('id_pnwr')->on('pms_pnwr_mst');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pms_pnwr_materi');
    }
}
