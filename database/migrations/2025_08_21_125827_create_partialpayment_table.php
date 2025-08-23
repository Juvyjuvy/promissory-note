<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $t) {
            $t->id();
            // FK to promissory_notes.pn_id
            $t->foreignId('pn_id')->constrained('promissory_notes', 'pn_id')->cascadeOnDelete();
            $t->decimal('amount', 12, 2);
            $t->string('method')->nullable();     // e.g., Cash, GCash, Bank
            $t->string('reference')->nullable();  // OR#, txn id, etc.
            $t->timestamp('paid_at')->useCurrent();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
