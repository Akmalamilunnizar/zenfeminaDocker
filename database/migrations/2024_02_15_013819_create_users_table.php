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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->nullable();
            $table->string('email', 100)->unique();
            $table->text('profile_img')->nullable();
            $table->date('birthDate')->nullable();
            $table->string('password');
<<<<<<< HEAD:database/migrations/2024_02_15_013819_create_users_table.php
            $table->string('token', 100)->unique('user_token')->nullable();
=======
>>>>>>> 848c087 (Pesan commit Anda):database/migrations/2014_10_12_000000_create_users_table.php
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
