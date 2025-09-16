<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Slider extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'image_path',
        'order',
        'is_active',
    ];
}