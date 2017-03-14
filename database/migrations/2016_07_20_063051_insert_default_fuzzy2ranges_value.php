<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Fuzzy;
use Carbon\Carbon;

class InsertDefaultFuzzy2rangesValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $variant = [
            'fuzzy_' . Fuzzy::LOW,
            'fuzzy_' . Fuzzy::MID,
            'fuzzy_' . Fuzzy::HIGH,
            'projection_' . Fuzzy::LOW,
            'projection_' . Fuzzy::HIGH,
            'result_' . Fuzzy::LOW,
            'result_' . Fuzzy::MID,
            'result_' . Fuzzy::HIGH,
        ];

        $now = Carbon::now();

        foreach ($variant as $var) {
            DB::insert('INSERT INTO fuzzy2ranges (
                code,
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
