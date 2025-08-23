<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // already handled in create_promissory_notes_table; do nothing
        if (!Schema::hasTable('promissory_notes')) return;

        if (!Schema::hasColumn('promissory_notes','user_id')) {
            Schema::table('promissory_notes', function (Blueprint $table) {
                $table->foreignId('user_id')->after('pn_id')->constrained('users','id')->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        // optional: drop FK/column only if exists
        if (Schema::hasTable('promissory_notes') && Schema::hasColumn('promissory_notes','user_id')) {
            Schema::table('promissory_notes', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }
    }
};
