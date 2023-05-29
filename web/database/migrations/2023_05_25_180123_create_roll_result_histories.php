<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roll_result_histories', function (Blueprint $table) {
            $table->id();
            $table->string('dice_pattern');
            $table->integer('total_result');
            $table->json('dices_results');
            $table->string('user_ip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roll_result_histories');
    }
};
