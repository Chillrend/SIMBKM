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
        Schema::create('log_matakuliahs', function (Blueprint $table) {
            $table->id();
            $table->string('mata_kuliah');
            $table->string('sks');
            $table->unsignedBigInteger('kurikulum');
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('kurikulum')->references('id')->on('kurikulums')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_matakuliahs');
    }
};
