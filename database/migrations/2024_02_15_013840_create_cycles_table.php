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
        Schema::create('cycles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
<<<<<<< HEAD
            $table->enum('type', ['est', 'hist'])->default('hist');
            $table->integer('cycle_length');
            $table->integer('period_length');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
=======
            $table->enum('type', ['est', 'hist'])->nullable(false)->default('hist');
            $table->integer('cycle_length');
            $table->integer('period_length');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
>>>>>>> 9e6190f (add: user and cycle's migrations)

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cycles');
    }
};
