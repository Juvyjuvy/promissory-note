<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // 1) Add pn_id if missing
        Schema::table('evaluations', function (Blueprint $t) {
            if (!Schema::hasColumn('evaluations', 'pn_id')) {
                $t->unsignedBigInteger('pn_id')->nullable()->after('evaluation_id');
            }
        });

        // 2) Clean any orphans (safe even if table is empty)
        DB::statement("
            UPDATE evaluations e
            LEFT JOIN promissory_notes p ON e.pn_id = p.pn_id
            SET e.pn_id = NULL
            WHERE e.pn_id IS NOT NULL AND p.pn_id IS NULL
        ");

        // 3) Recreate the FK cleanly
        Schema::table('evaluations', function (Blueprint $t) {
            try { $t->dropForeign(['pn_id']); } catch (\Throwable $e) {}
            $t->foreign('pn_id')->references('pn_id')->on('promissory_notes')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('evaluations', function (Blueprint $t) {
            try { $t->dropForeign(['pn_id']); } catch (\Throwable $e) {}
            // keep the column on rollback to avoid data loss
        });
    }
};
