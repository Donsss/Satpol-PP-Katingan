<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Agenda extends Model
{
    use HasFactory, LogsActivity;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'judul',
        'tanggal',
        'waktu',
        'lokasi',
        'deskripsi',
    ];

    /**
     * Casts atribut ke tipe data asli.
     */
    protected $casts = [
        'tanggal' => 'date',
    ];
}