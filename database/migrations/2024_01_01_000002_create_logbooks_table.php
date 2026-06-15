<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('tanggal');
            $table->integer('hari_ke')->default(1);
            $table->string('judul_kegiatan');
            $table->text('deskripsi_kegiatan');
            $table->enum('kategori_kegiatan', [
                'Pengelolaan Media Sosial',
                'Publikasi Informasi Digital',
                'Pengolahan Data',
                'Desain Konten Digital',
                'Dokumentasi Kegiatan',
                'Peliputan Lapangan',
                'Strategi Komunikasi Digital',
                'Penyusunan Laporan',
                'Lainnya',
            ]);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->enum('status', ['Selesai', 'Sedang Berjalan', 'Ditunda'])->default('Selesai');
            $table->timestamps();

            $table->index(['user_id', 'tanggal']);
            $table->index('kategori_kegiatan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logbooks');
    }
};
