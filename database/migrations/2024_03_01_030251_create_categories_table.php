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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
