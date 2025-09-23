<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Perintah untuk mengubah nama tabel DARI 'kontaks' MENJADI 'kontak'
        Schema::rename('kontaks', 'kontak');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Perintah untuk mengembalikan jika di-rollback
        // DARI 'kontak' KEMBALI MENJADI 'kontaks'
        Schema::rename('kontak', 'kontaks');
    }
};
