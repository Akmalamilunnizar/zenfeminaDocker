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
        DB::unprepared('
            CREATE TRIGGER delete_reminder
            BEFORE DELETE ON users
            FOR EACH ROW
            BEGIN
                DELETE from reminders where user_id = OLD.id;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS delete_reminder ON users;');
    }
};
