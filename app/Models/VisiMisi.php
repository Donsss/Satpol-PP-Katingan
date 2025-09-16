<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class VisiMisi extends Model
{

    use LogsActivity;
    protected $fillable = [
        'visi',
        'misi',
    ];
}
