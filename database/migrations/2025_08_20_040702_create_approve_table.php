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
        Schema::create('approve', function (Blueprint $table) {
            $table->id('approve_id');
            $table->unsignedBigInteger('pn_id');
            $table->foreign('pn_id')->references('pn_id')->on('promissorynotes')->onDelete('cascade');
            $table->timestamp('approval_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approve');
    }
};