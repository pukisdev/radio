<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PmsFpDet extends Migration
{
    // private $alias = 'bi_pms.';
    private $alias = '';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->alias.'pms_fp_det', function (Blueprint $table) {
            $table->string('f_fp',64);
            $table->string('f_pnwr', 64);
            $table->mediumInteger('total_biaya', false, true);
            $table->tinyInteger('nilai_biaya_persen', false, true)->nullable();
            $table->mediumInteger('nilai_biaya', false, true);
            $table->tinyInteger('nilai_potongan_persen', false, true)->nullable();
            $table->mediumInteger('nilai_potongan', false, true)->nullable();
            $table->mediumInteger('nilai_hpp', false, true);
            $table->mediumInteger('nilai_ppn', false, true);
            $table->mediumInteger('nilai_akhir', false, true);
            $table->string('sys_user_update',32);
            $table->timestamp('sys_tgl_update')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('sys_status_aktif')->default('A');
        });

        Schema::table($this->alias.'pms_fp_det', function (Blueprint $table) {
            $table->foreign('f_fp')->references('id_fp')->on($this->alias.'pms_fp_mst');
            $table->foreign('f_pnwr')->references('id_pnwr')->on($this->alias.'pms_pnwr_mst');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop($this->alias.'pms_fp_det');
    }
}
