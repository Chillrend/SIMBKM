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
        Schema::create('log_logbooks', function (Blueprint $table) {
            $table->id();
            $table->string('owner');
            $table->text('body');
            $table->dateTime('tanggal_dibuat');
            // $table->timestamp('tanggal_dibuat', $precision = 0);
            $table->string('lokasi')->nullable();
            $table->text('excerpt');
            $table->string('logbook');
            $table->string('status_dosbing')->default('0');
            $table->string('status_pi')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_logbooks');
    }
};
