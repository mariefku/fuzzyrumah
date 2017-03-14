<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuzzysetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuzzysets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('competitor_price', 4);
            $table->string('current_price', 4);
            $table->string('before_price', 4);
            $table->string('result_price', 4)->nullable();
            $table->timestamps();

            $table->unique([
                'competitor_price',
                'current_price',
                'before_price',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fuzzysets');
    }
}
