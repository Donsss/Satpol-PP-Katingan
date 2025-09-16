<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Sejarah extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'sejarah';

    protected $fillable = [
        'konten',
    ];
}
