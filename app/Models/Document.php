<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Document extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'judul',
        'deskripsi',
        'file_path',
        'file_name',
        'file_size',
        'file_extension',
        'kategori',
        'is_public',
        'download_count',
        'user_id'
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'download_count' => 'integer'
    ];

    // Relasi ke user (uploader)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope untuk dokumen public
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    // Scope untuk filter kategori
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // Helper untuk format file size
    public function getFormattedSizeAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }
}