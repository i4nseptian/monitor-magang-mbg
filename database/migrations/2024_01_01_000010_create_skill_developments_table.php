<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skill_developments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('skill_name');
            $table->integer('nilai_awal')->default(0);
            $table->integer('nilai_akhir')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'skill_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skill_developments');
    }
};
