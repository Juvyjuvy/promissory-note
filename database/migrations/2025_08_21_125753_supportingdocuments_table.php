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
        Schema::create('supportingdocuments', function (Blueprint $table) {
            $table->bigIncrements('document_id');
            $table->unsignedBigInteger('pn_id');
            $table->foreign('pn_id')->references('pn_id')->on('promissorynotes')->onDelete('cascade');
            $table->string('file_name');
            $table->string('file_path');
            $table->timestamp('upload_date');
            $table->string('document_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supportingdocuments');
    }
};