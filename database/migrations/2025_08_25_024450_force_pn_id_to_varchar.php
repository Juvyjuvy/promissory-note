<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('promissory_notes')) return;

        // 1) Drop unique index first (in case blocking modify). Ignore if wala.
        try {
            DB::statement('ALTER TABLE `promissory_notes` DROP INDEX `promissory_notes_pn_id_unique`');
        } catch (\Throwable $e) {
            // ignore
        }

        // 2) Force-convert INT -> VARCHAR(191) NULL
        DB::statement('ALTER TABLE `promissory_notes` MODIFY `pn_id` VARCHAR(191) NULL');

        // 3) Re-create unique index (optional but recommended)
        try {
            DB::statement('CREATE UNIQUE INDEX `promissory_notes_pn_id_unique` ON `promissory_notes` (`pn_id`)');
        } catch (\Throwable $e) {
            // ignore if exists
        }
    }

    public function down(): void
    {
        // No-op (we won't revert pn_id to INT)
    }
};
