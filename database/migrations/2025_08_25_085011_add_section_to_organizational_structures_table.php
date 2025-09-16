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
        // Tambahkan kolom section setelah kolom 'position'
        $table->integer('section')->nullable()->after('position');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organizational_structures', function (Blueprint $table) {
            //
        });
    }
};
