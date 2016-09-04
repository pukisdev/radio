<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
// use Carbon; //' => 'Carbon\Carbon';

class PmsFpMst extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pms_fp_mst', function (Blueprint $table) {
            $table->string('id_fp',64)->primary();
            $table->integer('generate_ke',false, true);
            $table->string('f_customer', 16);
            $table->date('tgl_fp')->default(Carbon::now());
            $table->string('deskripsi_fp', 1024);
            $table->date('tgl_jatuh_tempo');
            $table->string('jenis_faktur', 128);
            $table->string('keterangan', 1024);
            $table->string('ttd', 128);
            $table->double('netto', 15,2);
            $table->string('netto_terbilang',1024);
            $table->string('sys_user_update',32);
            $table->timestamp('sys_tgl_update')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('sys_status_aktif')->default('A');
            // $table->unique(array('id_fp','generate_key'))
        });

        Schema::table('pms_fp_mst', function (Blueprint $table) {
            $table->foreign('f_customer')->references('id_customer')->on('pms_customer_mst');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pms_fp_mst');
    }
}
