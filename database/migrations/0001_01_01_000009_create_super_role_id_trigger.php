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
        // Create trigger function for INSERT
        DB::statement(
            <<<'SQL'
CREATE OR REPLACE FUNCTION prevent_multiple_role_id_1_insert()
RETURNS trigger AS $$
BEGIN
    IF NEW.role_id = 1 AND (SELECT COUNT(*) FROM users WHERE role_id = 1) >= 1 THEN
        RAISE EXCEPTION 'Only one user can have role_id of 1.';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;
SQL
        );

        // Create INSERT trigger
        DB::statement(
            <<<'SQL'
CREATE TRIGGER prevent_multiple_role_id_1
BEFORE INSERT ON users
FOR EACH ROW
EXECUTE FUNCTION prevent_multiple_role_id_1_insert();
SQL
        );

        // Create trigger function for UPDATE
        DB::statement(
            <<<'SQL'
CREATE OR REPLACE FUNCTION prevent_multiple_role_id_1_update()
RETURNS trigger AS $$
BEGIN
    IF NEW.role_id = 1 AND (SELECT COUNT(*) FROM users WHERE role_id = 1 AND id != NEW.id) >= 1 THEN
        RAISE EXCEPTION 'Only one user can have role_id of 1.';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;
SQL
        );

        // Create UPDATE trigger
        DB::statement(
            <<<'SQL'
CREATE TRIGGER prevent_update_role_id_1
BEFORE UPDATE ON users
FOR EACH ROW
EXECUTE FUNCTION prevent_multiple_role_id_1_update();
SQL
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS prevent_multiple_role_id_1 ON users;');
        DB::statement('DROP TRIGGER IF EXISTS prevent_update_role_id_1 ON users;');
        DB::statement('DROP FUNCTION IF EXISTS prevent_multiple_role_id_1_insert();');
        DB::statement('DROP FUNCTION IF EXISTS prevent_multiple_role_id_1_update();');
    }
};
