<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
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
            CREATE TRIGGER add_reminder
            AFTER INSERT ON users
            FOR EACH ROW
            BEGIN
                INSERT INTO reminders (type, user_id) VALUES
                ("periodStart", NEW.id),
                ("periodEnd", NEW.id),
                ("praying", NEW.id),
                ("fasting", NEW.id);
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS add_reminder ON users;');
    }
};
