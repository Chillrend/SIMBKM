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
        Schema::create('mbkms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nim');
            $table->unsignedBigInteger('fakultas');
            $table->unsignedBigInteger('jurusan');
            $table->string('semester');
            $table->unsignedBigInteger('program');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('tempat_program_perusahaan');
            $table->string('lokasi_program')->nullable();
            $table->string('lokasi_mobilisasi')->nullable();
            $table->string('program_keberapa');
            $table->string('mobilisasi')->nullable();
            $table->unsignedBigInteger('dosen_pembimbing')->nullable();
            $table->unsignedBigInteger('pembimbing_industri')->nullable();
            $table->string('informasi_tambahan')->nullable();
            $table->unsignedBigInteger('user');
            $table->timestamps();


            $table->foreign('fakultas')->references('id')->on('fakultas')->cascadeOnDelete();
            $table->foreign('jurusan')->references('id')->on('jurusan')->cascadeOnDelete();
            $table->foreign('program')->references('id')->on('program_mbkms')->cascadeOnDelete();
            $table->foreign('dosen_pembimbing')->references('id')->on('users');
            $table->foreign('pembimbing_industri')->references('id')->on('users');
            $table->foreign('tahun_ajaran')->references('id')->on('tahun_ajaran_mbkms');
            $table->foreign('user')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mbkms');
    }
};
