<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nisn', 100)->notNull();
            $table->string('namasiswa', 100)->notNull();
            $table->string('jeniskelamin', 20)->notNull();
            $table->unsignedBigInteger('jurusan');
            $table->foreign('jurusan')->references('id')->on('tbl_rombongan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
