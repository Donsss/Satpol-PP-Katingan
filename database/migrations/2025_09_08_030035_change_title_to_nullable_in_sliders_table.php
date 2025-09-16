<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            // Mengubah kolom 'title' agar bisa menerima nilai NULL
            $table->string('title')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            // Mengembalikan seperti semula jika migrasi di-rollback
            $table->string('title')->nullable(false)->change();
        });
    }
};