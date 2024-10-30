<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    // database/migrations/xxxx_xx_xx_create_rides_table.php
    public function up()
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('strava_id')->unique();
            $table->string('name');
            $table->float('distance');
            $table->float('moving_time');
            $table->float('elevation_gain');
            $table->timestamp('start_date');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
