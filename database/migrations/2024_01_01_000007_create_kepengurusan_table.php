<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kepengurusan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggota')->cascadeOnDelete();
            $table->foreignId('periode_id')->constrained('periode')->cascadeOnDelete();
            $table->foreignId('biro_id')->nullable()->constrained('biro')->nullOnDelete();
            $table->string('jabatan', 100);
            $table->enum('level', ['bph', 'ketua_biro', 'anggota_biro']);
            $table->tinyInteger('urutan')->default(0);
            $table->timestamps();
            $table->unique(['anggota_id', 'periode_id', 'jabatan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kepengurusan');
    }
};
