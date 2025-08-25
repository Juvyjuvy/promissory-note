<?php

// database/migrations/2025_08_24_000001_add_email_archived_to_promissory_notes.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('promissory_notes')) return;

        Schema::table('promissory_notes', function (Blueprint $t) {
            if (!Schema::hasColumn('promissory_notes', 'email')) {
                $t->string('email')->nullable();
            }
            if (!Schema::hasColumn('promissory_notes', 'archived')) {
                $t->boolean('archived')->default(false);
            }
            if (!Schema::hasColumn('promissory_notes', 'pn_id')) {
                $t->string('pn_id')->unique();
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('promissory_notes')) return;

        Schema::table('promissory_notes', function (Blueprint $t) {
            if (Schema::hasColumn('promissory_notes', 'archived')) $t->dropColumn('archived');
            if (Schema::hasColumn('promissory_notes', 'email'))    $t->dropColumn('email');
            // keep pn_id to avoid breaking references
        });
    }
};
