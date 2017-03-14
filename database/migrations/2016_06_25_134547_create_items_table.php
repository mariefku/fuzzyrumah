<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');

            // first fuzzy
            $table->integer('competitor_price');
            $table->integer('current_price');
            $table->integer('before_price');
            $table->integer('fuzzy_price');
            $table->string('fuzzy_calculation');

            // second fuzzy
            $table->integer('projection_profit');
            $table->integer('fuzzy2_price');
            $table->string('fuzzy2_calculation');

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
        Schema::drop('items');
    }
}
