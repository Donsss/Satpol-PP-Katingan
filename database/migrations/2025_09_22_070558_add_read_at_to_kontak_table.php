<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kontak', function (Blueprint $table) {
            // Tambahkan kolom read_at setelah kolom isi_pesan
            // Nullable berarti jika isinya NULL, pesan dianggap belum dibaca
            $table->timestamp('read_at')->nullable()->after('isi_pesan');
        });
    }

    public function down(): void
    {
        Schema::table('kontak', function (Blueprint $table) {
            $table->dropColumn('read_at');
        });
    }
};
