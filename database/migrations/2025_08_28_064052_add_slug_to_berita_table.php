<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_xxxxxx_add_slug_to_berita_table.php
public function up(): void
{
    Schema::table('berita', function (Blueprint $table) {
        // Tambahkan kolom slug setelah kolom 'judul'
        $table->string('slug')->after('judul')->nullable(); 
    });
}

public function down(): void
{
    Schema::table('berita', function (Blueprint $table) {
        $table->dropColumn('slug');
    });
}
};
