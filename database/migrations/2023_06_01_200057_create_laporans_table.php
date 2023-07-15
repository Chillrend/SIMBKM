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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('dokumen_name')->default('belum ada file laporan');
            $table->string('dokumen_path')->nullable();
            $table->string('json_annotate')->nullable();
            $table->string('sign_first')->nullable();
            $table->string('sign_second')->nullable();
            $table->string('sign_third')->nullable();
            $table->string('sign_fourth')->nullable();
            $table->string('mbkm');
            $table->string('status')->default('sedang berjalan');
            $table->string('owner');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
