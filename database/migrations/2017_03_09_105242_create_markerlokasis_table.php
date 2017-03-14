<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarkerlokasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markerlokasis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_lokasi');
            $table->double('lat',20,10);
            $table->double('lng',20,10);
            $table->string('kategori_lokasi')
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
        Schema::drop('markerlokasis');
    }
}
