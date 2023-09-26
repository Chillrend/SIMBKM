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
            $table->unsignedBigInteger('role_kedua')->nullable();
            $table->unsignedBigInteger('role_ketiga')->nullable();
            $table->unsignedBigInteger('fakultas_id')->nullable();
            $table->unsignedBigInteger('jurusan_id')->nullable();
            $table->string('status')->default('Aktif');
            $table->string('nim')->nullable();
            $table->string('sso_pnj')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role')->references('id')->on('roles')->noActionOnDelete();
            $table->foreign('role_kedua')->references('id')->on('roles')->noActionOnDelete();
            $table->foreign('role_ketiga')->references('id')->on('roles')->noActionOnDelete();
            $table->foreign('fakultas_id')->references('id')->on('fakultas')->cascadeOnDelete();
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->cascadeOnDelete();

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
