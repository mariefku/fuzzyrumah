<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Fuzzy;
use Carbon\Carbon;

class InsertDefaultFuzzysetsValue extends Migration
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

        $now = Carbon::now();

        foreach ($variant as $var_competitor) {
            foreach ($variant as $var_current) {
                foreach ($variant as $var_before) {
                    DB::insert('INSERT INTO fuzzysets (
                        competitor_price,
                        current_price,
                        before_price,
                        result_price,
                        updated_at,
                        created_at
                    ) VALUES (?, ?, ?, ?, ?, ?)', [
                        $var_competitor,
                        $var_current,
                        $var_before,
                        Fuzzy::LOW,
                        $now,
                        $now
                    ]);
                }
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
