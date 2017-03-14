<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Fuzzy;
use Carbon\Carbon;

class InsertDefaultFuzzy2setsValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $variant = [
            Fuzzy::LOW,
            Fuzzy::MID,
            Fuzzy::HIGH,
        ];

        $variant_no_mid = [
            Fuzzy::LOW,
            Fuzzy::HIGH
        ];

        $now = Carbon::now();

        foreach ($variant as $var1) {
            foreach ($variant_no_mid as $var2) {
                DB::insert('INSERT INTO fuzzy2sets (
                    fuzzy_price,
                    projection_profit,
                    result_price,
                    updated_at,
                    created_at
                ) VALUES (?, ?, ?, ?, ?)', [
                    $var1,
                    $var2,
                    Fuzzy::LOW,
                    $now,
                    $now
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
