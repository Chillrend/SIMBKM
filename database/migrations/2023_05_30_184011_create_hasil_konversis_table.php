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
        Schema::create('hasil_konversis', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('dalam pemeriksaan');
            $table->unsignedBigInteger('kurikulum');
            $table->unsignedBigInteger('owner');
            $table->timestamps();

            $table->foreign('kurikulum')->references('id')->on('kurikulums')->cascadeOnDelete();
            $table->foreign('owner')->references('id')->on('users')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_konversis');
    }
};
