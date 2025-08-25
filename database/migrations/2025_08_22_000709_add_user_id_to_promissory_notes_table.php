// database/migrations/2025_08_25_000001_fix_promissory_columns.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Requires doctrine/dbal for ->change()
        // composer require doctrine/dbal
        Schema::table('promissory_notes', function (Blueprint $t) {
            // pn_id must be string (to allow 'PN-2025-001')
            $t->string('pn_id', 191)->nullable()->change();

            // student_id has dashes/leading zeros → string, not int
            if (Schema::hasColumn('promissory_notes', 'student_id')) {
                $t->string('student_id', 50)->nullable()->change();
            }

            // attachments should be JSON
            if (Schema::hasColumn('promissory_notes', 'attachments')) {
                $t->json('attachments')->nullable()->change();
            } else {
                $t->json('attachments')->nullable();
            }

            // due_date must be date/datetime; make nullable to avoid '?'
            if (Schema::hasColumn('promissory_notes', 'due_date')) {
                $t->date('due_date')->nullable()->change();
            } else {
                $t->date('due_date')->nullable();
            }

            // make sure these exist with safe defaults
            if (!Schema::hasColumn('promissory_notes', 'status')) {
                $t->string('status', 50)->default('pending');
            }
            if (!Schema::hasColumn('promissory_notes', 'email')) {
                $t->string('email')->nullable();
            }
            if (!Schema::hasColumn('promissory_notes', 'archived')) {
                $t->boolean('archived')->default(false);
            }

            // unique constraint for human-facing PN code
            $t->unique('pn_id', 'promissory_notes_pn_id_unique');
        });
    }

    public function down(): void
    {
        Schema::table('promissory_notes', function (Blueprint $t) {
            // keep pn_id as string; no risky rollback
            if (Schema::hasColumn('promissory_notes', 'archived')) $t->dropColumn('archived');
            // $t->dropUnique('promissory_notes_pn_id_unique'); // optional
        });
    }
};
