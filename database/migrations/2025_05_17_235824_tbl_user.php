<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_user', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 50)->notNull();
            $table->string('email', 50)->notNull();
            $table->string('password', 256)->notNull();
            $table->integer('role')->notNull();
            $table->tinyInteger('id_role')->notNull();
            $table->integer('is_active')->notNull();
            $table->timestamps();
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
