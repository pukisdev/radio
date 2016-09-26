<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UmumSupplierMst extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umum_supplier_mst', function (Blueprint $table) {
            //
            $table->string('id_supplier', 16)->primary();
            $table->string('nama_supplier', 128);
            $table->string('coa_id', 64)->nullable();
            $table->string('sys_user_created',16);
            $table->string('sys_user_updated',16)->nullable();
            $table->timestamp('sys_tgl_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('sys_tgl_updated')->nullable();
            $table->enum('sys_status_aktif',['A','N'])->default('A');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('umum_supplier_mst');
    }
}
