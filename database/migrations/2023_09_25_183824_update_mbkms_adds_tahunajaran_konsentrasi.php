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
        Schema::table('mbkms', function (Blueprint $table){
            $table->string('tahun_ajaran')->default('2023/2024 Ganjil');
            $table->string('konsentrasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mbkms', function (Blueprint $table){
            $table->dropColumn('tahun_ajaran');
            $table->dropColumn('konsentrasi');
        });
    }
};
