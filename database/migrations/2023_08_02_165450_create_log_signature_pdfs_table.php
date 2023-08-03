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
        Schema::create('log_signature_pdfs', function (Blueprint $table) {
            $table->id();
            $table->string('laporan_id')->unique();
            $table->string('json_sign_pertama')->nullable();
            $table->string('json_background_pertama')->nullable();
            $table->string('file_background_pertama')->nullable();
            $table->string('json_sign_kedua')->nullable();
            $table->string('json_background_kedua')->nullable();
            $table->string('file_background_kedua')->nullable();
            $table->string('json_sign_ketiga')->nullable();
            $table->string('json_background_ketiga')->nullable();
            $table->string('file_background_ketiga')->nullable();
            $table->string('json_sign_keempat')->nullable();
            $table->string('json_background_keempat')->nullable();
            $table->string('file_background_keempat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_signature_pdfs');
    }
};
