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
<<<<<<< HEAD
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
=======
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
<<<<<<<< HEAD:database/migrations/2024_03_01_030251_create_categories_table.php
            $table->string('name');
========
            $table->string('username', 30);
            $table->string('email', 100);
            $table->text('profile_img');
            $table->date('birthDate');
            $table->enum('role', ['admin', 'user'])->nullable(false)->default('user');
            $table->string('password');
>>>>>>>> 9e6190f (add: user and cycle's migrations):database/migrations/2024_02_15_013819_create_users_table.php
>>>>>>> 9e6190f (add: user and cycle's migrations)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<< HEAD
        Schema::dropIfExists('users');
=======
        Schema::dropIfExists('categories');
>>>>>>> 9e6190f (add: user and cycle's migrations)
    }
};
