<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('biro_id')->nullable()->constrained('biro')->nullOnDelete();
            $table->string('judul', 255);
            $table->string('slug', 270)->unique();
            $table->text('deskripsi')->nullable();
            $table->date('tanggal');
            $table->string('lokasi', 200)->nullable();
            $table->string('thumbnail', 255)->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
