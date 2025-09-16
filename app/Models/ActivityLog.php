<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'loggable_id',
        'loggable_type',
    ];

    /**
     * Relasi ke model User yang melakukan aksi.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi polymorphic ke model mana pun yang dicatat (Berita, Album, Document).
     */
    public function loggable()
    {
        return $this->morphTo();
    }
}
