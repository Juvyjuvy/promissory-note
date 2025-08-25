<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('promissory_notes')) return;

        Schema::table('promissory_notes', function (Blueprint $table) {
            if (!Schema::hasColumn('promissory_notes', 'email')) {
                // don’t use ->after() to avoid relying on any specific column order
                $table->string('email')->nullable();
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('promissory_notes')) return;

        Schema::table('promissory_notes', function (Blueprint $table) {
            if (Schema::hasColumn('promissory_notes', 'email')) {
                $table->dropColumn('email');
            }
        });
    }
};
