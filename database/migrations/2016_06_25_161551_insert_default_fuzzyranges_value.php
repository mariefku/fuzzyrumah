<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Fuzzy;
use Carbon\Carbon;

class InsertDefaultFuzzyrangesValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $variant = [
            'njop_' . Fuzzy::LOW,
            'njop_' . Fuzzy::MID,
            'njop_' . Fuzzy::HIGH,
            'kondisi_' . Fuzzy::LOW,
            'kondisi_' . Fuzzy::MID,            
            'kondisi_' . Fuzzy::HIGH,
            'usia_' . Fuzzy::LOW,
            'usia_' . Fuzzy::MID,
            'usia_' . Fuzzy::HIGH,
            'result_' . Fuzzy::LOW,
            'result_' . Fuzzy::MID,
            'result_' . Fuzzy::HIGH,            
        ];

        $now = Carbon::now();

        foreach ($variant as $var) {
            DB::insert('INSERT INTO fuzzyranges (
                state,
                min,
                max,
                updated_at,
                created_at
            ) VALUES (?, ?, ?, ?, ?)', [
                $var,
                0,
                1000000,
                $now,
                $now
            ]);
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
