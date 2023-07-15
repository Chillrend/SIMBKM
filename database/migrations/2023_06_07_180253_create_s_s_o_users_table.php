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
        Schema::create('s_s_o_users', function (Blueprint $table) {
            $table->id();
            $table->string('sub')->nullable();
            $table->string('ident')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('department_and_level')->nullable();
            $table->string('role')->nullable();
            $table->string('role_kedua')->nullable();
            $table->string('fakultas_id')->nullable();
            $table->string('jurusan_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_s_o_users');
    }
};
