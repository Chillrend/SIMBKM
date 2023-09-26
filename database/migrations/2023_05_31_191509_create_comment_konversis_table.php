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
        Schema::create('comment_konversis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hasil_konversi');
            $table->text('body')->nullable();
            $table->unsignedBigInteger('owner');
            $table->timestamps();

            $table->foreign('hasil_konversi')->references('id')->on('hasil_konversis')->cascadeOnDelete();
            $table->foreign('owner')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_konversis');
    }
};
