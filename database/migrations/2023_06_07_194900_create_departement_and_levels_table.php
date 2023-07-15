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
        Schema::create('departement_and_levels', function (Blueprint $table) {
            $table->id();
            $table->string('access_level')->nullable();
            $table->string('access_level_name')->nullable();
            $table->string('department')->nullable();
            $table->string('department_short_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departement_and_levels');
    }
};
