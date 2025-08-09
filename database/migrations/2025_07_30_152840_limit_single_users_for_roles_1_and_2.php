<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ✅ Create the trigger (NO DELIMITER)
        DB::unprepared("
            CREATE TRIGGER one_user_with_role_id_1
            BEFORE INSERT ON users
            FOR EACH ROW
            BEGIN
                IF NEW.role_id = 1 AND (SELECT COUNT(*) FROM users WHERE role_id = 1) > 0 THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Only one user can have role_id = 1';
                END IF;
            END
        ");

        // ❌ Partial indexes like WHERE role_id = 2 are NOT supported in MariaDB/MySQL < 8
        // Comment or remove the line below if you're using MariaDB
        // DB::statement("CREATE UNIQUE INDEX one_user_with_role_id_2 ON users ((role_id)) WHERE role_id = 2;");
    }

    public function down(): void
    {
        // ✅ Drop the trigger
        DB::unprepared("DROP TRIGGER IF EXISTS one_user_with_role_id_1");

        // ❌ Will not work unless UNIQUE INDEX was actually created above (and is valid for your DB)
        // DB::statement("DROP INDEX IF EXISTS one_user_with_role_id_2;");
    }
};
