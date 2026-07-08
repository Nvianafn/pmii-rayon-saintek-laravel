<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('biro', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('slug', 120)->unique();
            $table->text('deskripsi')->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('warna_aksen', 7)->nullable();
            $table->tinyInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('biro');
    }
};
