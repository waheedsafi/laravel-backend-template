<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Trigger to prevent inserting a second user with role_id = 1
        DB::statement('
            CREATE TRIGGER prevent_multiple_role_id_1
            BEFORE INSERT ON users
            FOR EACH ROW
            BEGIN
                IF NEW.role_id = 1 AND (SELECT COUNT(*) FROM users WHERE role_id = 1) >= 1 THEN
                    SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "Only one user can have role_id of 1.";
                END IF;
            END;
        ');

        // Trigger to prevent updating to role_id = 1 if another user already has it
        DB::statement('
            CREATE TRIGGER prevent_update_role_id_1
            BEFORE UPDATE ON users
            FOR EACH ROW
            BEGIN
                IF NEW.role_id = 1 AND (SELECT COUNT(*) FROM users WHERE role_id = 1 AND id != NEW.id) >= 1 THEN
                    SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "Only one user can have role_id of 1.";
                END IF;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS prevent_multiple_role_id_1;');
        DB::statement('DROP TRIGGER IF EXISTS prevent_update_role_id_1;');
    }
};
