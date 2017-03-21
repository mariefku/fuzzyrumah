<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetabloksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petabloks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_area');
            $table->string('area_lokasi');
            $table->integer('harga_area' 11);
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
        Schema::drop('petabloks');
    }
}
