<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentor_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // mahasiswa
            $table->foreignId('mentor_id')->constrained('users')->cascadeOnDelete(); // mentor
            $table->date('tanggal');
            $table->text('catatan');
            $table->text('evaluasi')->nullable();
            $table->enum('status', [
                'Sangat Baik',
                'Baik',
                'Cukup',
                'Perlu Perbaikan',
            ])->default('Baik');
            $table->timestamps();

            $table->index(['user_id', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentor_notes');
    }
};
