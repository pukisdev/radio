<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hkm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hkm_spks_mst', function (Blueprint $table) {
            //
            $table->string('id_spks',64)->primary();
            $table->string('alias_spks',64);
            $table->string('f_customer', 16);
            $table->string('nama',64);
            $table->date('tgl_awal')->nullable();
            $table->date('tgl_akhir')->nullable();
            $table->string('draft',512)->nullable();
            $table->string('files',512)->nullable();
            $table->string('keterangan',512)->nullable();

            $table->string('sys_user_created',16);
            $table->string('sys_user_updated',16)->nullable();
            $table->timestamp('sys_tgl_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('sys_tgl_updated')->nullable();
            $table->enum('sys_status_aktif',['A','N'])->default('A');            
        });

        Schema::create('hkm_spks_apv', function (Blueprint $table) {
            //
            $table->string('f_spks',64);
            $table->string('apv_nip', 16);
            $table->enum('apv_status',['Y','T'])->nullable();
            $table->date('apv_tgl')->nullable();
            $table->enum('mandatori',['Y','T'])->nullable();
            $table->string('keterangan',512)->nullable();

            $table->string('sys_user_created',16);
            $table->string('sys_user_updated',16)->nullable();
            $table->timestamp('sys_tgl_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('sys_tgl_updated')->nullable();
            $table->enum('sys_status_aktif',['A','N'])->default('A');            
        });

        Schema::table('hkm_spks_apv', function (Blueprint $table) {
            $table->foreign('f_spks')->references('id_spks')->on('hkm_spks_mst');
        });        

        Schema::table('pms_pnwr_mst', function (Blueprint $table) {
            $table->foreign('f_spks')->references('id_spks')->on('hkm_spks_mst');
        });    

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hkm_spks_mst');
        Schema::drop('hkm_spks_apv');
        // Schema::table('hkm_spks_mst', function (Blueprint $table) {
        //     //
        // });
    }
}
