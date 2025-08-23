<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Ensure table exists
        if (!Schema::hasTable('evaluations')) {
            // If wala pa jud, create na lang cleanly
            Schema::create('evaluations', function (Blueprint $t) {
                $t->engine = 'InnoDB';
                $t->bigIncrements('evaluation_id');
                $t->unsignedBigInteger('pn_id')->nullable();
                $t->foreignId('evaluator_id')->nullable()->constrained('users','id')->cascadeOnDelete();
                $t->enum('decision', ['approved','rejected'])->index();
                $t->text('reason')->nullable();
                $t->timestamp('evaluated_at')->useCurrent();
                $t->timestamps();
            });
            Schema::table('evaluations', function (Blueprint $t) {
                $t->foreign('pn_id')->references('pn_id')->on('promissory_notes')->cascadeOnDelete();
            });
            return;
        }

        // 1) Add pn_id column if missing
        Schema::table('evaluations', function (Blueprint $t) {
            if (!Schema::hasColumn('evaluations', 'pn_id')) {
                $t->unsignedBigInteger('pn_id')->nullable()->after('evaluation_id');
            }
        });

        // 2) If naay old column (promissory_note_id), copy its values to pn_id
        if (Schema::hasColumn('evaluations', 'promissory_note_id')) {
            DB::statement('UPDATE evaluations SET pn_id = promissory_note_id WHERE pn_id IS NULL');
        }

        // 3) Remove any existing FK on pn_id first (if any), then add correct FK
        Schema::table('evaluations', function (Blueprint $t) {
            // try dropping old FK names safely
            try { $t->dropForeign(['pn_id']); } catch (\Throwable $e) {}
        });

        // Clean orphans so FK add won’t fail
        DB::statement("
            UPDATE evaluations e
            LEFT JOIN promissory_notes p ON e.pn_id = p.pn_id
            SET e.pn_id = NULL
            WHERE e.pn_id IS NOT NULL AND p.pn_id IS NULL
        ");

        Schema::table('evaluations', function (Blueprint $t) {
            $t->foreign('pn_id')->references('pn_id')->on('promissory_notes')->cascadeOnDelete();
        });

        // 4) Ensure evaluator_id exists & FK (optional hardening)
        Schema::table('evaluations', function (Blueprint $t) {
            if (!Schema::hasColumn('evaluations', 'evaluator_id')) {
                $t->foreignId('evaluator_id')->nullable()->after('pn_id')->constrained('users','id')->cascadeOnDelete();
            } else {
                try { $t->dropForeign(['evaluator_id']); } catch (\Throwable $e) {}
                $t->foreign('evaluator_id')->references('id')->on('users')->cascadeOnDelete();
            }
        });

        // 5) Ensure decision column exists (for completeness)
        Schema::table('evaluations', function (Blueprint $t) {
            if (!Schema::hasColumn('evaluations', 'decision')) {
                $t->enum('decision', ['approved','rejected'])->index()->after('evaluator_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('evaluations', function (Blueprint $t) {
            try { $t->dropForeign(['pn_id']); } catch (\Throwable $e) {}
            try { $t->dropForeign(['evaluator_id']); } catch (\Throwable $e) {}
            // Keep columns for safety; or drop if you really want to roll back
            // $t->dropColumn(['pn_id','evaluator_id','decision']);
        });
    }
};
