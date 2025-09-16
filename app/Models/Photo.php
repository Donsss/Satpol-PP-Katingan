<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Photo extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['album_id', 'judul', 'deskripsi', 'path'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}