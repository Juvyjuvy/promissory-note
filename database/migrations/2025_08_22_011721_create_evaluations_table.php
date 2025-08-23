<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // If table doesn't exist yet, create it cleanly and exit
        if (!Schema::hasTable('evaluations')) {
            Schema::create('evaluations', function (Blueprint $t) {
                $t->engine = 'InnoDB';
                $t->bigIncrements('evaluation_id');
                $t->unsignedBigInteger('pn_id')->nullable();              // allow null during migration
                $t->foreignId('evaluator_id')->nullable()->constrained('users','id')->cascadeOnDelete();
                $t->enum('decision', ['approved','rejected'])->index();
                $t->text('reason')->nullable();
                $t->timestamp('evaluated_at')->useCurrent();
                $t->timestamps();
            });

            // Add FK after create (FK will allow NULLs)
            Schema::table('evaluations', function (Blueprint $t) {
                $t->foreign('pn_id')->references('pn_id')->on('promissory_notes')->cascadeOnDelete();
            });

            return;
        }

        // ---- Rebuild using a temp table (no doctrine/dbal required) ----
        Schema::create('evaluations_tmp', function (Blueprint $t) {
            $t->engine = 'InnoDB';
            $t->bigIncrements('evaluation_id');
            $t->unsignedBigInteger('pn_id')->nullable();              // nullable so we can clean orphans
            $t->foreignId('evaluator_id')->nullable()->constrained('users','id')->cascadeOnDelete();
            $t->enum('decision', ['approved','rejected'])->index();
            $t->text('reason')->nullable();
            $t->timestamp('evaluated_at')->useCurrent();
            $t->timestamps();
        });

        // Copy data from old evaluations → tmp (map pn id from either pn_id or promissory_note_id)
        // Fallbacks protect if columns don't exist.
        $hasPnId        = Schema::hasColumn('evaluations','pn_id');
        $hasOldPnId     = Schema::hasColumn('evaluations','promissory_note_id');
        $hasEvalId      = Schema::hasColumn('evaluations','evaluator_id');
        $hasDecision    = Schema::hasColumn('evaluations','decision');
        $hasReason      = Schema::hasColumn('evaluations','reason');
        $hasEvaluatedAt = Schema::hasColumn('evaluations','evaluated_at');
        $hasCreatedAt   = Schema::hasColumn('evaluations','created_at');
        $hasUpdatedAt   = Schema::hasColumn('evaluations','updated_at');

        // Build a dynamic SELECT to avoid errors if some columns are missing
        $selectPnId = $hasPnId ? 'e.pn_id' : ($hasOldPnId ? 'e.promissory_note_id' : 'NULL');
        $selectEvaluator = $hasEvalId ? 'e.evaluator_id' : 'NULL';
        $selectDecision  = $hasDecision ? "CASE WHEN e.decision IN ('approved','rejected') THEN e.decision ELSE 'approved' END" : "'approved'";
        $selectReason    = $hasReason ? 'e.reason' : 'NULL';
        $selectEvalAt    = $hasEvaluatedAt ? 'e.evaluated_at' : 'NOW()';
        $selectCreated   = $hasCreatedAt ? 'e.created_at' : 'NOW()';
        $selectUpdated   = $hasUpdatedAt ? 'e.updated_at' : 'NOW()';

        DB::statement("
            INSERT INTO evaluations_tmp (pn_id, evaluator_id, decision, reason, evaluated_at, created_at, updated_at)
            SELECT
                {$selectPnId}      AS pn_id,
                {$selectEvaluator} AS evaluator_id,
                {$selectDecision}  AS decision,
                {$selectReason}    AS reason,
                {$selectEvalAt}    AS evaluated_at,
                {$selectCreated}   AS created_at,
                {$selectUpdated}   AS updated_at
            FROM evaluations e
        ");

        // Null-out any orphan pn_id values so the FK can be added
        DB::statement("
            UPDATE evaluations_tmp et
            LEFT JOIN promissory_notes p ON et.pn_id = p.pn_id
            SET et.pn_id = NULL
            WHERE p.pn_id IS NULL
        ");

        // Replace old table with the new one
        Schema::drop('evaluations');
        Schema::rename('evaluations_tmp', 'evaluations');

        // Finally, add the FK (pn_id remains nullable, which is fine)
        Schema::table('evaluations', function (Blueprint $t) {
            $t->foreign('pn_id')->references('pn_id')->on('promissory_notes')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        // We won't try to reconstruct the old broken shape; just drop cleanly.
        Schema::dropIfExists('evaluations');
    }
};
