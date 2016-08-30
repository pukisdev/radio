<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sdm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sdm_perusahaan_mst', function (Blueprint $table) {
            $table->string('id_perusahaan',5)->primary();
            $table->string('root',5)->nullabel();
            $table->string('nama_perusahaan',64);
            $table->string('alamat',512);

            $table->string('sys_user_created',16);
            $table->string('sys_user_updated',16)->nullable();
            $table->timestamp('sys_tgl_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('sys_tgl_updated')->nullable();
            $table->enum('sys_status_aktif',['A','N'])->default('A');            
        });

        Schema::create('sdm_golongan_mst', function(Blueprint $table){
            $table->string('id_golongan', 10)->primary();
            $table->string('keterangan', 45);

            $table->string('sys_user_created',16);
            $table->string('sys_user_updated',16)->nullable();
            $table->timestamp('sys_tgl_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('sys_tgl_updated')->nullable();
            $table->enum('sys_status_aktif',['A','N'])->default('A');            
        });

        Schema::create('sdm_status_kerja_mst', function(Blueprint $table){
            $table->string('id_status_kerja',16)->primary();
            $table->string('nama_status',45);

            $table->string('sys_user_created',16);
            $table->string('sys_user_updated',16)->nullable();
            $table->timestamp('sys_tgl_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('sys_tgl_updated')->nullable();
            $table->enum('sys_status_aktif',['A','N'])->default('A');            
        });

        Schema::create('sdm_status_kawin_mst', function(Blueprint $table){
            $table->string('id_status_kawin', 5)->primary();
            $table->string('nama_status', 64);

            $table->string('sys_user_created',16);
            $table->string('sys_user_updated',16)->nullable();
            $table->timestamp('sys_tgl_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('sys_tgl_updated')->nullable();
            $table->enum('sys_status_aktif',['A','N'])->default('A');            

        });

        Schema::create('sdm_agama_mst', function(Blueprint $table){
            $table->string('id_agama',5)->primary();
            $table->string('nama_agama', 64);

            $table->string('sys_user_created',16);
            $table->string('sys_user_updated',16)->nullable();
            $table->timestamp('sys_tgl_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('sys_tgl_updated')->nullable();
            $table->enum('sys_status_aktif',['A','N'])->default('A');            
        });

        Schema::create('sdm_ou_mst', function(Blueprint $table){
            $table->string('id_ou',64)->primary();
            $table->string('root',64)->nullable();
            $table->string('alias_id', 256);
            $table->string('ket_depan', 45);
            $table->string('nama_ou', 128);

            $table->string('sys_user_created',16);
            $table->string('sys_user_updated',16)->nullable();
            $table->timestamp('sys_tgl_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('sys_tgl_updated')->nullable();
            $table->enum('sys_status_aktif',['A','N'])->default('A');            

        });

        Schema::create('sdm_jabatan_mst', function(Blueprint $table){
            $table->string('id_jabatan',64)->primary();
            $table->string('root',64)->nullable();
            $table->string('alias_id',128);
            $table->string('nama_jabatan', 64);

            $table->string('sys_user_created',16);
            $table->string('sys_user_updated',16)->nullable();
            $table->timestamp('sys_tgl_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('sys_tgl_updated')->nullable();
            $table->enum('sys_status_aktif',['A','N'])->default('A');                        
        });

        Schema::create('sdm_bank_mst', function(Blueprint $table){
            $table->string('id_bank', 10)->primary();
            $table->string('nama_bank', 128);

            $table->string('sys_user_created',16);
            $table->string('sys_user_updated',16)->nullable();
            $table->timestamp('sys_tgl_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('sys_tgl_updated')->nullable();
            $table->enum('sys_status_aktif',['A','N'])->default('A');            
        });

        // Schema::create('sdm_bank_cabang', function(Blueprint $table){
        //     $table->increment('id_cabang', 11);
        //     $table->string('f_bank', 10);
        //     $table->string('nama_cabang', 128);
        //     $table->string('no_rekening', 64);
        //     $table->string('alamat', 256)->nullable();
        //     $table->string('telpon', 64)->nullable();

        //     $table->string('sys_user_created',16);
        //     $table->string('sys_user_updated',16)->nullable();
        //     $table->timestamp('sys_tgl_created')->default(DB::raw('CURRENT_TIMESTAMP'));
        //     $table->timestamp('sys_tgl_updated')->nullable();
        //     $table->enum('sys_status_aktif',['A','N'])->default('A');            
        // });

        // Schema::table('sdm_bank_cabang', function(Blueprint $table){
        //     $table->foreign('f_bank')->references('id_bank')->on('sdm_bank_mst');
        // })


        Schema::create('sdm_pegawai_mst', function(Blueprint $table){
            $table->string('nip_sys', 16)->primary();
            $table->string('nip_alias', 64);
            $table->string('nama', 128);
            $table->string('tempat_lahir', 64);
            $table->date('tgl_lahir');
            $table->enum('kelamin',['LAKI-LAKI','PEREMPUAN']);
            $table->text('alamat_tinggal');
            $table->text('alamat_ktp')->nullable();
            $table->date('tgl_masuk');
            $table->string('telpon', 64)->nullable();
            $table->string('no_hp', 64);
            $table->string('no_npwp', 64)->nullabl();
            $table->string('no_identitas', 64)->nullable(); //sebaiknya dipecah.. karena memungkinkan input lebih dari 1 identitas
            $table->string('no_jamsostek', 64)->nullable();
            $table->string('f_perusahaan', 5);
            $table->string('f_golongan', 10);
            $table->string('f_status_kerja', 16);
            $table->string('f_status_kawin', 5);
            $table->string('f_agama', 5);
            $table->string('f_kewarganegaraan', 128)->default('INDONESIA');
            $table->string('f_bank', 10)->nullable();
            $table->string('no_rekening', 64)->nullable();
            $table->string('foto', 128)->nullable();
            $table->string('email', 256)->nullable();

            $table->string('sys_user_created',16);
            $table->string('sys_user_updated',16)->nullable();
            $table->timestamp('sys_tgl_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('sys_tgl_updated')->nullable();
            $table->enum('sys_status_aktif',['A','N'])->default('A');            
        });

        Schema::table('sdm_pegawai_mst', function(Blueprint $table){
            $table->foreign('f_perusahaan')->references('id_perusahaan')->on('sdm_perusahaan_mst');
            $table->foreign('f_golongan')->references('id_golongan')->on('sdm_golongan_mst');
            $table->foreign('f_status_kerja')->references('id_status_kerja')->on('sdm_status_kerja_mst');
            $table->foreign('f_status_kawin')->references('id_status_kawin')->on('sdm_status_kawin_mst');
            $table->foreign('f_agama')->references('id_agama')->on('sdm_agama_mst');
            $table->foreign('f_kewarganegaraan')->references('id_negara')->on('sys_negara_mst');
            $table->foreign('f_bank')->references('id_bank')->on('sdm_bank_mst');
        });

        Schema::create('sdm_jabatan_pegawai_trx', function(Blueprint $table){
            $table->string('f_nip', 16);
            $table->string('f_ou', 64);
            $table->string('f_jabatan', 64);
            $table->string('no_sk', 128)->nullable();
            $table->string('keterangan', 256)->nullable();

            $table->string('sys_user_created',16);
            $table->string('sys_user_updated',16)->nullable();
            $table->timestamp('sys_tgl_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('sys_tgl_updated')->nullable();
            $table->enum('sys_status_aktif',['A','N'])->default('A');            
        });

        Schema::table('sdm_jabatan_pegawai_trx', function(Blueprint $table){
            $table->foreign('f_nip')->references('nip_sys')->on('sdm_pegawai_mst');
            $table->foreign('f_ou')->references('id_ou')->on('sdm_ou_mst');
            $table->foreign('f_jabatan')->references('id_jabatan')->on('sdm_jabatan_mst');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sdm_jabatan_pegawai_trx');
        Schema::drop('sdm_pegawai_mst');
        Schema::drop('sdm_bank_mst');
        Schema::drop('sdm_jabatan_mst');
        Schema::drop('sdm_status_kerja_mst');
        Schema::drop('sdm_status_kawin_mst');
        Schema::drop('sdm_agama_mst');
        Schema::drop('sdm_ou_mst');        
        Schema::drop('sdm_golongan_mst');        
        Schema::drop('sdm_perusahaan_mst');
    }
}
