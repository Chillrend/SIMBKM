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
        Schema::create('comment_laporans', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->unsignedBigInteger('laporan');
            $table->unsignedBigInteger('user');
            $table->timestamps();

            $table->foreign('laporan')->references('id')->on('laporans')->cascadeOnDelete();
            $table->foreign('user')->references('id')->on('users')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_laporans');
    }
};
