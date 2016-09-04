<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('sys_user_mst', function (Blueprint $table) {
            // $table->increments('f_nip_sys');
            // $table->increments('id');
            $table->string('f_nip_sys', 16)->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('is_online',['Y','T']);
            $table->rememberToken();
            // $table->timestamps();
            $table->string('sys_user_created',16)->nullable();
            $table->string('sys_user_updated',16)->nullable();
            $table->timestamp('sys_tgl_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('sys_tgl_updated')->nullable();
            $table->enum('sys_status_aktif',['A','N'])->default('A');            
        });
 
        // Schema::create('users', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('name');
        //     $table->string('email')->unique();
        //     $table->string('password');
        //     $table->rememberToken();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
