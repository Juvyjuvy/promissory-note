<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('evaluations');

        Schema::create('evaluations', function (Blueprint $t) {
            $t->engine = 'InnoDB';
            $t->bigIncrements('evaluation_id');
            $t->unsignedBigInteger('pn_id');
            $t->foreignId('evaluator_id')->constrained('users','id')->cascadeOnDelete();
            $t->enum('decision', ['approved','rejected'])->index();
            $t->text('reason')->nullable();
            $t->timestamp('evaluated_at')->useCurrent();
            $t->timestamps();

            $t->foreign('pn_id')->references('pn_id')->on('promissory_notes')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
