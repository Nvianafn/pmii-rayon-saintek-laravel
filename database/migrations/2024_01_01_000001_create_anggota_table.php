<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 20)->unique();
            $table->string('nama_lengkap', 150);
            $table->string('nama_panggilan', 50)->nullable();
            $table->year('angkatan');
            $table->string('fakultas', 100)->nullable();
            $table->string('prodi', 100)->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->string('foto', 255)->nullable();
            $table->text('bio')->nullable();
            $table->enum('status', ['aktif', 'alumni', 'non-aktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
