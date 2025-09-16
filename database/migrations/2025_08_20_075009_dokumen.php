<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('file_path'); // Path penyimpanan file
            $table->string('file_name'); // Nama asli file
            $table->string('file_size')->nullable(); // Ukuran file
            $table->string('file_extension'); // Ekstensi file (pdf, docx, etc)
            $table->string('kategori')->nullable(); // Kategori dokumen
            $table->boolean('is_public')->default(true); // Status publik/private
            $table->integer('download_count')->default(0); // Counter download
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Uploader
            $table->timestamps();
            
            // Index untuk optimasi query
            $table->index('kategori');
            $table->index('is_public');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
};