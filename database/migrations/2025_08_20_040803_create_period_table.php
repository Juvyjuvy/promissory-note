<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('period', function (Blueprint $table) {
            $table->id('payment_id');
            $table->unsignedBigInteger('pn_id');
            $table->foreign('pn_id')->references('pn_id')->on('promissorynotes')->onDelete('cascade');
            $table->string('term');
            $table->string('semester');
            $table->string('school_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('period');
    }
};