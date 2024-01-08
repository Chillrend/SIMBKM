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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->unsignedBigInteger('role')->nullable();
            $table->unsignedBigInteger('additional_role')->nullable();
            $table->string('api_jurusan_id')->nullable();
            $table->string('api_prodi_id')->nullable();
            $table->string('status')->default('Aktif');
            $table->string('nim')->nullable();
            $table->string('sso_pnj')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role')->references('id')->on('roles')->noActionOnDelete();
            $table->foreign('additional_role')->references('id')->on('roles')->noActionOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
