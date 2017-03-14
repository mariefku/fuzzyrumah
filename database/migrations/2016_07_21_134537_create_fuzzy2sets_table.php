<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuzzy2setsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuzzy2sets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fuzzy_price', 4);
            $table->string('projection_profit', 4);
            $table->string('result_price', 4)->nullable();
            $table->timestamps();

            $table->unique([
                'fuzzy_price',
                'projection_profit'
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
        Schema::drop('fuzzy2sets');
    }
}
