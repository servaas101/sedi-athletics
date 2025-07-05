<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if meet_id column exists
        if (Schema::hasColumn('disciplines', 'meet_id')) {
            Schema::table('disciplines', function (Blueprint $table) {
                // Drop foreign key constraints that reference meet_id
                $foreignKeys = DB::select("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'disciplines' AND COLUMN_NAME = 'meet_id' AND CONSTRAINT_NAME != 'PRIMARY'");
                foreach ($foreignKeys as $fk) {
                    DB::statement("ALTER TABLE disciplines DROP FOREIGN KEY {$fk->CONSTRAINT_NAME}");
                }
                
                // Rename the column
                $table->renameColumn('meet_id', 'competition_id');
            });
        }
        
        // Add the new foreign key if competition_id column exists
        if (Schema::hasColumn('disciplines', 'competition_id')) {
            Schema::table('disciplines', function (Blueprint $table) {
                $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('disciplines', function (Blueprint $table) {
            $table->dropForeign(['competition_id']);
            $table->renameColumn('competition_id', 'meet_id');
            $table->foreign('meet_id')->references('id')->on('meets')->onDelete('cascade');
        });
    }
};
