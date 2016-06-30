<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmsProdukMst extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        // Schema::create('bi_pms.pms_produk_mst', function (Blueprint $table) {
        Schema::create('pms_produk_mst', function (Blueprint $table) {
            $table->string('id_produk', 16)->primary();
            $table->string('nama', 32);
            $table->bigInteger('durasi', false, true);//->index();
            $table->enum('satuan_durasi', ['detik', 'menit']);
            $table->string('sys_user_update',32);
            $table->timestamp('sys_tgl_update')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
            $table->string('sys_status_aktif')->default('A')->nullable();
        });

        // delete FROM `migrations` where migration='2016_05_08_103339_create_pms_produk_mst';
        // DB::statement('alter table pms_produk_mst drop primary key');
        // DB::statement("alter table pms_produk_mst add primary key('id_produk')");

        // Schema::table('pms_produk_mst', function (Blueprint $table) {
        //     $table->dropPrimary('durasi');
        //     $table->primary('id_produk');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        // Schema::drop('bi_pms.pms_produk_mst');
        Schema::drop('pms_produk_mst');
    }
}
