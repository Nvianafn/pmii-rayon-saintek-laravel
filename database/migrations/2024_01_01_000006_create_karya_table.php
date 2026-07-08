<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karya', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->nullable()->constrained('anggota')->nullOnDelete();
            $table->string('judul', 255);
            $table->string('slug', 270)->unique();
            $table->enum('tipe', ['artikel', 'esai', 'puisi', 'berita']);
            $table->longText('konten');
            $table->text('excerpt')->nullable();
            $table->string('thumbnail', 255)->nullable();
            $table->json('tags')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karya');
    }
};
