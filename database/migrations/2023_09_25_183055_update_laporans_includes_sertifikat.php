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
        Schema::table('laporans', function (Blueprint $table){
            $table->string('dokumen_sertifikat_name')->default('belum ada file sertifikat')->nullable();
            $table->string('dokumen_sertifikat_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table){
            $table->dropColumn('dokumen_sertifikat_path');
            $table->dropColumn('dokumen_sertifikat_name');
        });
    }
};
