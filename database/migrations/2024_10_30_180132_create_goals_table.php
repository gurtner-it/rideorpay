<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoalsTable extends Migration
{
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('target_hours')->default(0);
            $table->integer('actual_hours')->default(0);
            $table->string('brand')->nullable();  // Brand associated with the goal
            $table->decimal('discount_amount', 8, 2)->default(0); // Discount amount as a decimal
            $table->decimal('penalty_amount', 8, 2)->default(0); // Penalty amount as a decimal
            $table->boolean('met')->default(false); // Track if goal is met
            $table->dateTime('verification_date')->nullable(); // Verification date to check after a week
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('goals');
    }
}