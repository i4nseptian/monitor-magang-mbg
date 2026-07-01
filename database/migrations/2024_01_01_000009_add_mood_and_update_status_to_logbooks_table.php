<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('logbooks', function (Blueprint $table) {
            $table->string('mood')->nullable()->after('status');
        });

        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE logbooks MODIFY COLUMN status VARCHAR(50) NOT NULL DEFAULT 'Draft'");
        }
    }

    public function down(): void
    {
        Schema::table('logbooks', function (Blueprint $table) {
            $table->dropColumn('mood');
        });

        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE logbooks MODIFY COLUMN status ENUM('Selesai','Sedang Berjalan','Ditunda') NOT NULL DEFAULT 'Selesai'");
        }
    }
};
