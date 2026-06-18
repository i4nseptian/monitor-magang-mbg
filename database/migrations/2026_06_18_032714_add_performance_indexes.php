<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('logbooks', function (Blueprint $table) {
            $table->index('tanggal');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->index('status_project');
            $table->index(['status_project', 'created_at']);
        });

        Schema::table('targets', function (Blueprint $table) {
            $table->index(['target_date', 'progress']);
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::table('logbooks', function (Blueprint $table) {
            $table->dropIndex(['tanggal']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex(['status_project']);
            $table->dropIndex(['status_project', 'created_at']);
        });

        Schema::table('targets', function (Blueprint $table) {
            $table->dropIndex(['target_date', 'progress']);
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });
    }
};
