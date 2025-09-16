<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Traits\LogsActivity;

class Berita extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'berita';
    protected $fillable = ['id_user', 'judul', 'berita', 'thumbnail', 'status', 'views', 'slug'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    const STATUS_DRAFT = 'draft';
    const STATUS_ARCHIVE = 'archive';
    const STATUS_PUBLISH = 'publish';

    public static function getStatuses()
    {
        return [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_ARCHIVE => 'Archive', 
            self::STATUS_PUBLISH => 'Publish'
        ];
    }

    protected static function booted(): void
    {
        static::saving(function ($berita) {
            $berita->slug = Str::slug($berita->judul);
        });
    }
}