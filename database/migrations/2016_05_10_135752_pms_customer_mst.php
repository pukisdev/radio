<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PmsCustomerMst extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pms_customer_mst', function (Blueprint $table) {
            //
            $table->string('id_customer', 16)->primary();
            $table->string('nama_customer', 128);
            $table->string('coa_id', 64)->nullable();
            $table->string('sys_user_update',32);
            $table->timestamp('sys_tgl_update')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('sys_status_aktif')->default('A');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pms_customer_mst');
    }
}
