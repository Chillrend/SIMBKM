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
            $table->unsignedBigInteger('tahun_ajaran')->nullable();
            $table->string('konsentrasi')->nullable();

            $table->foreign('tahun_ajaran')->references('id')->on('tahun_ajaran_mbkms');
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
