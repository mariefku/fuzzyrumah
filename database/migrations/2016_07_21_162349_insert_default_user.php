<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;
use Carbon\Carbon;

class InsertDefaultUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now = Carbon::now();
        DB::insert('INSERT INTO users (
            name,
            email,
            password,
            level,
            updated_at,
            created_at
        ) VALUES (?, ?, ?, ?, ?, ?)', [
            "Admin",
            "admin@example.com",
            Hash::make("admin123"),
            "ADMIN",
            $now,
            $now
        ]);
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
