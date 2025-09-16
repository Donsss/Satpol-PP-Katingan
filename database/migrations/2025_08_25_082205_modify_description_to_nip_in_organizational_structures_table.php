<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('organizational_structures', function (Blueprint $table) {
        $table->dropColumn('description'); // Hapus kolom description
        $table->string('nip')->nullable()->after('position'); // Tambah kolom nip
    });
}

public function down(): void
{
    Schema::table('organizational_structures', function (Blueprint $table) {
        $table->text('description')->nullable()->after('position'); // Kembalikan kolom description
        $table->dropColumn('nip'); // Hapus kolom nip
    });
}
};
