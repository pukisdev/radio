<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class PmsPnwrSpk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pms_pnwr_spk', function (Blueprint $table) {
            $table->string('id_spk',64)->primary();
            $table->string('f_pnwr',64);
            $table->string('pihak_pertama', 8);
            $table->string('jabatan_pihak_pertama', 256);
            $table->string('pihak_kedua', 64);
            $table->string('jabatan_pihak_kedua', 256);
            $table->date('tgl_spk')->default(Carbon::now());
            $table->string('sys_user_update',32);
            $table->timestamp('sys_tgl_update')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('sys_status_aktif')->default('A');
        });

        Schema::table('pms_pnwr_spk', function (Blueprint $table) {
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
        Schema::drop('pms_pnwr_spk');
    }
}
