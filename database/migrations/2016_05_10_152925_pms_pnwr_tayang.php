<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PmsPnwrTayang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pms_pnwr_tayang', function (Blueprint $table) {
            $table->string('f_pnwr',64);
            $table->date('tayang_tgl');
            $table->string('tayang_jam', 256);
            $table->string('tayang_realisasi', 256)->nullable();
            $table->string('sys_user_update',32);
            $table->timestamp('sys_tgl_update')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('sys_status_aktif')->default('A');
        });

        Schema::table('pms_pnwr_tayang', function (Blueprint $table) {
            $table->foreign('f_pnwr')->references('id_pnwr')->on('pms_pnwr_mst');
            // $table->unique(['f_pnwr, tayang_tgl']);
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pms_pnwr_tayang');
    }
}
